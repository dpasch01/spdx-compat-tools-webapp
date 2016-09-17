var DOT_URL="http://localhost:8080/SPDXLicenseCompatibility/rest/license/graph/";
var LICENSES_URL="http://localhost:8080/SPDXLicenseCompatibility/rest/license/licenses/";
var NODE_URL="http://localhost:8080/SPDXLicenseCompatibility/rest/license/node/";
var EDGE_URL="http://localhost:8080/SPDXLicenseCompatibility/rest/license/edge/";

var network;

$(".active").removeClass("active");
$("a[href=\"graph.php\"]").parent().addClass("active");

initialize();

function initialize(){
    var container = document.getElementById('mynetwork');
    var clusterIndex = 0;
    var clusters = [];
    var lastClusterZoomLevel = 0;
    var clusterFactor = 0.9;
    var options = {
        interaction: {
            navigationButtons: true,
            keyboard: true
        },
        edges:{
            arrows: {
                to:     {enabled: true, scaleFactor:1},
                middle: {enabled: false, scaleFactor:1},
                from:   {enabled: false, scaleFactor:1}
            },
            color:{
                color:"black",
                highlight:'#2BB673'
            },
            width: 2,
            shadow:true
        },
        nodes:{
            color:{
                background:'#00B1F2',
                border:'#006991',
                highlight: {
                    border: '#94350F',
                    background: '#F1592A'
                }
            },
            shape: 'dot',
            size: 30,
            font: {
                size: 32
            },
            borderWidth: 2,
            shadow:true
        },
        manipulation: {
            addNode: function (data, callback) {
                $('#modal').modal('toggle');
                var span = document.getElementById('operation');
                var idInput = document.getElementById('node-id');
                var labelInput = document.getElementById('node-label');
                var saveButton = document.getElementById('saveButton');
                var cancelButton = document.getElementById('cancelButton');
                $('#modal #operation.modal-title').html("Add Node");
                idInput.value = network.body.nodeIndices[network.body.nodeIndices.length-1]+1;
                labelInput.value = data.label;
                saveButton.onclick = saveData.bind(this,data,callback);
                cancelButton.onclick = clearPopUp.bind();
            },
            addEdge: function (data, callback) {
                var span = document.getElementById('operation');

                var edgeFrom = document.getElementById('edge-from-input');
                var edgeTo = document.getElementById('edge-to-input');

                var saveButton = document.getElementById('edge-saveButton');
                var cancelButton = document.getElementById('edge-cancelButton');
                span.innerHTML = "Add Edge";

                $.each(network.nodesHandler.body.nodes, function (index,node) {
                    if(node.id==data.to){
                        edgeTo.value=node.labelModule.lines[0];
                        return false;
                    }
                });

                $.each(network.nodesHandler.body.nodes, function (index,node) {
                    if(node.id==data.from){
                        edgeFrom.value=node.labelModule.lines[0];
                        return false;
                    }
                });

                $("#edge-form").submit(function(event){
                    var edgeCategory=$('input[name="edge-types"]:checked', '#edge-modal').val();
                    var transitive;

                    if(edgeCategory=="TRANSITIVE"){
                        transitive=true;
                        network.edgesHandler.options.color.color="black"
                    }else{
                        transitive=false;
                        network.edgesHandler.options.color.color="maroon"
                    }

                    callback(data);

                    var edgeJSON={"nodeIdentifier":nodeIdentifierMaker(edgeFrom.value),"transitivity":transitive,"nodeIdentifiers":[{"identifier":nodeIdentifierMaker(edgeTo.value)}]};
                    console.log(edgeJSON);

                    $.ajax({
                        url:EDGE_URL,
                        type:"POST",
                        data:JSON.stringify(edgeJSON),
                        dataType:"JSON",
                        success:function(response){
                            console.log(response);
                            if(response.status=="success"){
                                callback(data);
                                initialize();
                            }else{
                                swal("Error",response.message,"error");
                            }
                        },
                        contentType:"text/plain"
                    });

                    $('#edge-modal').modal('toggle');
                    event.preventDefault();
                });

                if (data.from == data.to) {
                    swal({
                        title: "Are you sure?",
                        text: "You are trying to connect the node with itself.",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-primary",
                        confirmButtonText: "Yes, do it!",
                        closeOnConfirm: true
                    },
                        function(isConfirm) {
                            if (isConfirm) {
                                $('#edge-modal').modal('toggle');
                            }
                        });
                }else {
                    $('#edge-modal').modal('toggle');
                }
            },
            editEdge:false,
            deleteNode:false,
            deleteEdge:false
        }
    };

    $('#loading').removeClass('hidden');
    $.ajax({
        url:DOT_URL,
        type:"GET",
        success:function(response){
            $('#loading').addClass('hidden');
            $('#graph-content').removeClass('hidden');

            var data = vis.network.convertDot(response);
            network = new vis.Network(container, data, options);

            network.once('initRedraw', function() {
                if (lastClusterZoomLevel === 0) {
                    lastClusterZoomLevel = network.getScale();
                }
            });

            network.on('zoom', function (params) {
                if (params.direction == '-') {
                    if (params.scale < lastClusterZoomLevel*clusterFactor) {
                        makeClusters(params.scale);
                        lastClusterZoomLevel = params.scale;
                    }
                }
                else {
                    openClusters(params.scale);
                }
            });


            network.on("selectNode", function (params) {
                if (params.nodes.length == 1) {
                    if (network.isCluster(params.nodes[0]) == true) {
                        network.openCluster(params.nodes[0])
                    }
                }
            });

            function makeClusters(scale) {
                var clusterOptionsByData = {
                    processProperties: function (clusterOptions, childNodes) {
                        clusterIndex = clusterIndex + 1;
                        var childrenCount = 0;
                        for (var i = 0; i < childNodes.length; i++) {
                            childrenCount += childNodes[i].childrenCount || 1;
                        }
                        clusterOptions.childrenCount = childrenCount;
                        clusterOptions.label = "# " + childrenCount + "";
                        clusterOptions.font = {size: childrenCount*5+30}
                        clusterOptions.id = 'cluster:' + clusterIndex;
                        clusters.push({id:'cluster:' + clusterIndex, scale:scale});
                        return clusterOptions;
                    },
                    clusterNodeProperties: {borderWidth: 3, shape: 'database', font: {size: 30}}
                }
                network.clusterOutliers(clusterOptionsByData);
            }

            function openClusters(scale) {
                var newClusters = [];
                var declustered = false;
                for (var i = 0; i < clusters.length; i++) {
                    if (clusters[i].scale < scale) {
                        network.openCluster(clusters[i].id);
                        lastClusterZoomLevel = scale;
                        declustered = true;
                    }
                    else {
                        newClusters.push(clusters[i])
                    }
                }
                clusters = newClusters;
            }

            console.log(network);

            $.ajax({
                url:LICENSES_URL,
                type:"GET",
                success:function(licensesList){

                    var licenseIndex=0;
                    $.each(licensesList.licenses,function(key,license){
                        $('#licenses-list').append("<a id="+licenseIndex+" href='#' data-toggle='tooltip' data-placement='right' title='"+license.identifier+"' class='list-group-item'>"+license.identifier+"</a>");
                        licenseIndex++;
                    });

                    $(function () {
                      $('[data-toggle="tooltip"]').tooltip()
                    })

                    $('#licenses-list a.list-group-item').bind('click',function(event){
                        $.each(network.nodesHandler.body.nodes, function (index,node) {
                            node.selected=false;
                            $.each(node.edges, function (index,edge) {
                                edge.selected=false;
                            });
                        });

                        if($(this).hasClass('active')){
                            $(this).removeClass('active');
                        }else{
                            $('#licenses-list a.list-group-item.active').removeClass('active');
                            $(this).addClass('active');

                            $.each(network.nodesHandler.body.nodes, function (index,node) {
                                node.selected=false;
                                $.each(node.edges, function (index,edge) {
                                    edge.selected=false;
                                });
                            });

                            $.each(network.nodesHandler.body.nodes, function (index,node) {
                                node.selected=false;
                                $.each(node.edges, function (index,edge) {
                                    edge.selected=false;
                                });
                            });

                            var nodeIdentityNumber=[findLicenseNode($(this).html())];

                            $.each(network.getConnectedNodes(nodeIdentityNumber+""), function (index,nodeId) {
                                $.each(network.nodesHandler.body.nodes, function (index,node) {
                                    if(node.id==nodeId && node.id){
                                        node.options.color.highlight.background='#2BB62A';
                                        node.options.color.highlight.border='#088518';
                                        node.selected=true;
                                    }
                                    //network.selectNodes(network.getConnectedNodes(nodeIdentityNumber+""));
                                });
                            });

                            network.selectNodes(nodeIdentityNumber,true);
                        }

                    });

                }
            });

        },
        error:function(data) {
            $('#server-error').removeClass('hidden');
            $('#loading').addClass('hidden');
        }
    });
}

$(document).ready(function() {

    $.ajax({
        url:"spdx/licenses-spdx.php",
        type:"GET",
        success:function(response){
            licensesJSON=JSON.parse(response);
            $.each(licensesJSON,function(key,license){
                $('#modal .modal-body #nodeLicenses').append('<option value="'+license.toLowerCase()+'">'+license+'</option>');
                console.log(license);
            });
            $('#nodeLicenses').multiselect({
                enableFiltering: true,
                filterBehavior: 'value'
            });
        }
    });

});

function destroy() {
    if (network !== null) {
        network.destroy();
        network = null;
    }
}

function clearPopUp() {
    var saveButton = document.getElementById('saveButton');
    var cancelButton = document.getElementById('cancelButton');
    saveButton.onclick = null;
    cancelButton.onclick = null;
}

function saveData(data,callback) {
    data.id = document.getElementById('node-id').value;

    var label="[";
    $.each($('#modal ul.multiselect-container.dropdown-menu li.active label'),function(key,license){
        label+=license.textContent.trim()+', ';
    });
    label=label.substr(0,label.length-2);
    label+=']';

    var nodeIdentifier=nodeIdentifierMaker(label);
    var nodeCategory=$('input[name="node-types"]:checked', '#modal').val();

    var nodeJSON={"nodeIdentifier":nodeIdentifier,"nodeCategory":nodeCategory,"nodelicenses":[]};
    $.each($('#modal ul.multiselect-container.dropdown-menu li.active label'),function(key,license){
        nodeJSON.nodelicenses.push({"identifier":license.textContent.trim()});
    });

    data.label = label;
    clearPopUp();

    $.ajax({
        url:NODE_URL,
        type:"POST",
        data:JSON.stringify(nodeJSON),
        dataType:"JSON",
        success:function(response){
            console.log(response);
            if(response.status=="success"){
                callback(data);
                destroy();
                initialize();
            }else{
                swal("Error",response.message,"error");
            }
        },
        contentType:"text/plain"
    });
}

function nodeIdentifierMaker(nodeLabel){
    nodeLabel=nodeLabel.substr(1,nodeLabel.length-2);
    nodeLabel=nodeLabel.replace(/, /g,'_');
    return nodeLabel;
}

function findLicenseNode(licenseIdentifier){
    var nodeIdentity;
    $.each(network.nodesHandler.body.nodes, function (index,node) {
        var labels=node.labelModule.lines[0];
        labels=labels.substr(1,labels.length-2);
        labels=labels.replace(/ /g,'');
        $.each(labels.split(','), function (index,license) {
            if(licenseIdentifier==license){
                nodeIdentity=node.id;
                return false;
            }
        });
        if(nodeIdentity!=undefined){
            return false;
        }
    });

    return nodeIdentity;
}
