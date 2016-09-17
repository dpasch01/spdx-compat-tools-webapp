var ANALYZE_URL="http://localhost:8080/SPDXLicenseCompatibility/rest/spdx/analyze/";
var VALIDATE_URL="http://localhost:8080/SPDXLicenseCompatibility/rest/spdx/validate/";
var CORRECT_URL="http://localhost:8080/SPDXLicenseCompatibility/rest/spdx/correct/";
var DOWNLOAD_URL="http://localhost:8080/SPDXLicenseCompatibility/rest/spdx/download/";

$(".active").removeClass("active");
$("a[href=\"index.php\"]").parent().addClass("active");

$("#spdx-files").fileinput({
    showPreview:false,
    maxFileCount: 5,
    browseClass: "btn btn-primary",
    uploadLabel:"Analyze",
    allowedFileTypes:["text"],
    allowedFileExtensions: ["rdf","spdx"],
    fileTypeSettings:{
        text: function(vType, vName) {
            return typeof vType !== "undefined" && vType.match('text.*') || vName.match(/\.(rdf|spdx)$/i);
        }
    }
});

$(".fileinput-remove").on('click', function(event) {
  location.reload();
});

$(document).ajaxStart(function(){
    $("#loading").show();
});

$('.refresh-btn').on('click',function(){
    localStorage.clear();
    $('.result').addClass('hidden');
    $("#spdx-files").fileinput('reset');
    $('.intro').removeClass('hidden');
    $("span.file-caption-ellipsis").remove();
    location.reload();
});

function handleResults(validationJSON){
    var spdxError = false;

    if(validationJSON.violation||((validationJSON.compatible!=undefined)&&(!validationJSON.compatible))){
        console.log(validationJSON.violation||!validationJSON.compatible);
        $(".result.jumbotron .result-title").html("A violation was found!");
        $(".result.jumbotron .result-content").html("<p><i>A violation was found during your analysis.</i></p>");

        if(validationJSON.unaries!=undefined){
            $.each(validationJSON.unaries,function(key,unary){
                if(!unary.compatible){
                    spdxError=true;
                    return false;
                }
            });

            if(spdxError){
                $(".result.jumbotron .result-content").append("<p><i>The violation located in one or more of your spdx files, you can view the error below.<br>Please review the problem and try again.</i></p>");
            }else{
                var resultContent="<p><i>There is a license compatibility conflict between the declared licenses of your files. ";
                if(validationJSON.adjustable){
                    resultContent+="Don't worry, there is one or more solutions to it, choose from the following proposed licenses : ";
                    var identifierCount=0;
                    $.each(validationJSON.proposal,function(key,license){
                         resultContent+="<a href='#'>"+license.identifier+"</a>";
                        if(identifierCount<(validationJSON.proposal.length-1)){
                            resultContent+=", ";
                            identifierCount++;
                        }else{
                             resultContent+=".</i></p>";
                        }
                    });
                    $(".result.jumbotron .result-content").append(resultContent);
                }else{
                    $(".result.jumbotron .result-content").append("<p><i>Unfortunately there are no possible solutions in our graph for the violation in your license. We are very sorry.</i></p>");
                }
            }
        }else{
            var resultContent="<p><i>Your file's analysis and validation has been completed with a conflict between your declared licenses.";
            if(validationJSON.adjustable){
                resultContent+="<br>Don't worry, there is one or more solutions to it, choose from the following proposed licenses : ";
                var identifierCount=0;
                $.each(validationJSON.proposal,function(key,license){
                     resultContent+="<a href='#'>"+license.identifier+"</a>";
                    if(identifierCount<(validationJSON.proposal.length-1)){
                        resultContent+=", ";
                        identifierCount++;
                    }else{
                         resultContent+=".</i></p>";
                    }
                });
                $(".result.jumbotron .result-content").append(resultContent);
            }else{
                $(".result.jumbotron .result-content").append("<p><i>Unfortunately there are no possible solutions in our graph for the violation in your license. We are very sorry.</i></p>");
            }
        }

    }else{
        $(".result.jumbotron .result-title").html("No violation found.");
        $(".result.jumbotron .result-content").html("<p><i>No violation was found during your spdx file's analysis.<br>You are good to go!.</i></p>");
    }

    var unaryCounter=1;
    if(validationJSON.unaries!=undefined){
        $.each(validationJSON.unaries,function(key,unary){

            if(unary.compatible){
                var unaryContent="";
                if(unary.concludedExists){
                    unaryContent="<li class='list-group-item concluded-warning'><div class='row'><div class='col-md-1'><b class='red index'>"+unaryCounter+"</b></div><div class='col-md-1'><i class='white fa fa-circle'></i></div><div class='col-md-4'><p><b class='blue'>File</b> : "+unary.file+"</p></div><div class='col-md-2'><p><b class='green'>Declared licenses</b> : ";
                }else{
                    unaryContent="<li class='list-group-item'><div class='row'><div class='col-md-1'><b class='red index'>"+unaryCounter+"</b></div><div class='col-md-1'><i class='yellow fa fa-circle'></i></div><div class='col-md-4'><p><b class='blue'>File</b> : "+unary.file+"</p></div><div class='col-md-2'><p><b class='green'>Declared licenses</b> : ";
                }
                $.each(unary.declared,function(key,license){
                    unaryContent+=license.identifier+", ";
                });
                unaryContent=unaryContent.substr(0,unaryContent.length-2);
                unaryContent+="</p></div><div class='col-md-3'><p><b class='yellow'>Extracted licenses</b> : "
                $.each(unary.extracted,function(key,license){
                    unaryContent+=license.identifier+", ";
                });
                unaryContent=unaryContent.substr(0,unaryContent.length-2);
                unaryContent+="</p></div><div class='col-md-1'></div></div></li>";
                $(".result.jumbotron .file-list").append(unaryContent);
            }else{
                var unaryContent="<li class='spdx-error list-group-item'><div class='row'><div class='col-md-1'><b class='red index'>"+unaryCounter+"</b></div><div class='col-md-1'><i class='error-font fa fa-circle'></i></div><div class='col-md-4'><p><b class='blue'>File</b> : "+unary.file+"</p></div><div class='col-md-2'><p><b class='green'>Declared licenses</b> : ";
            $.each(unary.declared,function(key,license){
                unaryContent+=license.identifier+", ";
            });
            unaryContent=unaryContent.substr(0,unaryContent.length-2);
            unaryContent+="</p></div><div class='col-md-3'><p><b class='yellow'>Extracted licenses</b> : "
            $.each(unary.extracted,function(key,license){
                unaryContent+=license.identifier+", ";
            });
            unaryContent=unaryContent.substr(0,unaryContent.length-2);
            unaryContent+="</p></div><div class='col-md-1'><a id='"+unary.file+"' href='#'> <i class='fa fa-cog fa-2x'></i></a></div></div></li>";
                $(".result.jumbotron .file-list").append(unaryContent);
            }
            unaryCounter++;
        });
    }else{
        var unary=validationJSON;
        if(unary.compatible){
            var unaryContent="";
            if(unary.concludedExists){
                unaryContent="<li class='list-group-item concluded-warning'><div class='row'><div class='col-md-1'><b class='red index'>"+unaryCounter+"</b></div><div class='col-md-1'><i class='white fa fa-circle'></i></div><div class='col-md-4'><p><b class='blue'>File</b> : "+unary.file+"</p></div><div class='col-md-2'><p><b class='green'>Declared licenses</b> : ";
            }else{
                unaryContent="<li class='list-group-item'><div class='row'><div class='col-md-1'><b class='red index'>"+unaryCounter+"</b></div><div class='col-md-1'><i class='yellow fa fa-circle'></i></div><div class='col-md-4'><p><b class='blue'>File</b> : "+unary.file+"</p></div><div class='col-md-3'><p><b class='green'>Declared licenses</b> : ";
            }
            $.each(unary.declared,function(key,license){
                unaryContent+=license.identifier+", ";
            });
            unaryContent=unaryContent.substr(0,unaryContent.length-2);
            unaryContent+="</p></div><div class='col-md-3'><p><b class='yellow'>Extracted licenses</b> : "
            $.each(unary.extracted,function(key,license){
                unaryContent+=license.identifier+", ";
            });
            unaryContent=unaryContent.substr(0,unaryContent.length-2);
            unaryContent+="</p></div></div></li>";
            $(".result.jumbotron .file-list").append(unaryContent);
        }else{
            var unaryContent="<li class='spdx-error list-group-item'><div class='row'><div class='col-md-1'><b class='red index'>"+unaryCounter+"</b></div><div class='col-md-1'><i class='error-font fa fa-circle'></i></div><div class='col-md-4'><p><b class='blue'>File</b> : "+unary.file+"</p></div><div class='col-md-2'><p><b class='green'>Declared licenses</b> : ";
            $.each(unary.declared,function(key,license){
                unaryContent+=license.identifier+", ";
            });
            unaryContent=unaryContent.substr(0,unaryContent.length-2);
            unaryContent+="</p></div><div class='col-md-3'><p><b class='yellow'>Extracted licenses</b> : "
            $.each(unary.extracted,function(key,license){
                unaryContent+=license.identifier+", ";
            });
            unaryContent=unaryContent.substr(0,unaryContent.length-2);
            unaryContent+="</p></div><div class='col-md-1'><a id='"+unary.file+"' href='#'> <i class='fa fa-cog fa-2x'></i></a></div></div></li>";
            $(".result.jumbotron .file-list").append(unaryContent);
        }
    }


    $(".jumbotron.result .file-list .spdx-error a").bind("click",function(){
        var analysis=JSON.parse(localStorage['analysis']);
        var file;

        if(localStorage["multiple"]=="true"){
            var files=JSON.parse(localStorage["files"]);
            var fileIndex=$("b.index",$(this).parent().parent()).html();
            file=files.files[fileIndex-1];
        }else{
            file=JSON.parse(localStorage["file"]);
        }

        localStorage["correct"]=JSON.stringify(file);
        $("#correctSpdxModal .modal-title").html(file.filename+".rdf");

        if(analysis.adjustable){
            $.each(analysis.proposal,function(key,license){
                $('#correctSpdxModal #correct-form #declaredLicense').append("<option value='"+license.identifier+"'>"+license.identifier+"</option>");
            });
            $("#correctSpdxModal").modal("toggle");
        }else{
            swal("We are sorry. There are no possible solutions.");
        }


    });
}

$('#correct-form').submit(function(event) {
    var file=JSON.parse(localStorage['correct']);
    var correctJSON={"filename":file.filename,"declared":$("#correctSpdxModal #declaredLicense option:selected" ).text(),"content":file.content};
    $('#correctSpdxModal').modal("toggle");

    $.ajax({
        url:CORRECT_URL,
        type:"POST",
        data:JSON.stringify(correctJSON),
        success:function(response){
            window.location=DOWNLOAD_URL;
        },
        contentType:"text/plain"
    });

    event.preventDefault();
});

$(".fileinput-upload-button").on("click",function(event){
    $('#spdx-uploader').submit(function(submitEvent) {
        var formData = new FormData($(this)[0]);

        var fileList=$('#spdx-files').get(0).files;

        if(fileList.length>1){
            $.ajax({
                url: "spdx/analyze-spdx.php",
                type: "POST",
                data: formData,
                async: true,
                success: function (data) {

                    localStorage["files"]=data;
                    localStorage["multiple"]="true";

                    $.ajax({
                        url:ANALYZE_URL,
                        type:"POST",
                        data:data,
                        dataType:"JSON",
                        success:function(response){

                            localStorage["analysis"]=JSON.stringify(response);

                            $("#loading").hide();
                            $('#spdx-uploader')[0].reset();
                            handleResults(response);

                            $(".intro.jumbotron").toggleClass('hidden');
                            $(".result.jumbotron").toggleClass('hidden');

                        },
                        contentType:"text/plain",
                        error:function(data) {
                            console.log(data);

                            swal({
                              title: "SPDX analysis failed",
                              text: "Error in file.",
                              type: "error",
                              showCancelButton: false,
                              closeOnConfirm: true
                            },
                            function(){
                              location.reload();
                            });

                            $("#spdx-files").fileinput('reset');
                            $('#loading').addClass('hidden');
                        }
                    });

                },
                cache: false,
                contentType: false,
                processData: false
            });
        }else{
            $.ajax({
                url: "spdx/validate-spdx.php",
                type: "POST",
                data: formData,
                async: true,
                success: function (data) {

                    localStorage["file"]=data;
                    localStorage["multiple"]="false";

                    $.ajax({
                        url:VALIDATE_URL,
                        type:"POST",
                        data:data,
                        dataType:"JSON",
                        success:function(response){

                            localStorage["analysis"]=JSON.stringify(response);

                            $("#loading").hide();
                            $('#spdx-uploader')[0].reset();
                            handleResults(response);

                            $(".intro.jumbotron").toggleClass('hidden');
                            $(".result.jumbotron").toggleClass('hidden');

                        },
                        error:function(data) {
                            console.log(data);
                            swal({
                              title: "SPDX analysis failed",
                              text: "Error in file.",
                              type: "error",
                              showCancelButton: false,
                              closeOnConfirm: true
                            },
                            function(){
                              location.reload();
                            });
                            $("#spdx-files").fileinput('reset');
                            $('#loading').addClass('hidden');
                        },
                        contentType:"text/plain"
                    });

                },
                cache: false,
                contentType: false,
                processData: false
            });
        }
        submitEvent.preventDefault();
    });

    $('#spdx-uploader').submit();
    event.preventDefault();
});

$("#browse-spdx-btn").on("click",function(event){
    $("#spdx-files").click();
});

$('#correctSpdxModal').on('hidden.bs.modal', function (e) {
    $('#correctSpdxModal .modal-title').html("");
    $('#correctSpdxModal .modal-body select').html("");
});

$(document).ajaxStop(function() {
  $("#loading").hide();
});
