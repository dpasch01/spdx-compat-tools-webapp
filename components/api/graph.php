<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
<!--
    <div class="panel panel-default">

        <div class="panel-heading" role="tab" id="dotHeader">
            <h4 class="panel-title">
                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#dot" aria-expanded="false" aria-controls="dot">
                    Receive the .dot file representing the graph
                </a>
            </h4>
        </div>
        <div id="dot" class="panel-collapse collapse" role="tabpanel" aria-labelledby="dotHeader">
            <div class="panel-body">
                 <div class="row">
                    <div class="col-md-4">
                        <h4>@Method</h4>
                        <h5>GET</h5>
                    </div>
                    <div class="col-md-4">
                        <h4>@Path</h4>
                        <h5>/license/graph/</h5>   
                    </div>
                    <div class="col-md-4">
                        <h4>@Info</h4>
                        <h5>The system response with the graph represention in dot format.</h5>
                    </div>
                </div>  
            </div>
        </div>

    </div>
-->
    <div class="panel panel-default">

        <div class="panel-heading" role="tab" id="nodesHeader">
            <h4 class="panel-title">
                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#nodes" aria-expanded="false" aria-controls="nodes">
                    Receive a list with all the graph's nodes
                </a>
            </h4>
        </div>
        <div id="nodes" class="panel-collapse collapse" role="tabpanel" aria-labelledby="nodesHeader">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-4">
                        <h4>@Method</h4>
                        <h5>GET</h5>
                    </div>
                    <div class="col-md-4">
                        <h4>@Path</h4>
                        <h5>/license/nodes/</h5>   
                    </div>
                    <div class="col-md-4">
                        <h4>@Info</h4>
                        <h5>The system response with a list consisting with all the license nodes of the graph.</h5>
                    </div>
                </div>  
            </div>
        </div>

    </div>
<!--
    <div class="panel panel-default">

        <div class="panel-heading" role="tab" id="edgesHeader">
            <h4 class="panel-title">
                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#edges" aria-expanded="false" aria-controls="edges">
                    Recieve a list with all the graph's edges
                </a>
            </h4>
        </div>
        <div id="edges" class="panel-collapse collapse" role="tabpanel" aria-labelledby="edgesHeader">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-4">
                        <h4>@Method</h4>
                        <h5>GET</h5>
                    </div>
                    <div class="col-md-4">
                        <h4>@Path</h4>
                        <h5>/license/edges/</h5>   
                    </div>
                    <div class="col-md-4">
                        <h4>@Info</h4>
                        <h5>The system response with a list consisting with all the edges between the license nodes of the graph.</h5>
                    </div>
                </div>  
            </div>
        </div>

    </div>
-->
    <div class="panel panel-default">

        <div class="panel-heading" role="tab" id="addNodeHeader">
            <h4 class="panel-title">
                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#addNode" aria-expanded="false" aria-controls="addNode">
                    Add a new license node to the graph
                </a>
            </h4>
        </div>
        <div id="addNode" class="panel-collapse collapse" role="tabpanel" aria-labelledby="addNodeHeader">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-4">
                        <h4>@Method</h4>
                        <h5>POST</h5>
                        </br>
                        <h4>@Path</h4>
                        <h5>/license/node/</h5>   
                        </br>
                        <h4>@Info</h4>
                        <h5>-</h5>
                    </div>
                    <div class="col-md-4">
                        <h4>@Request</h4>
                        <h5>Content-Type : application/json</h5>
                        <h5>Format :<br> 
                                <pre>
{
    "nodeIdentifier":"Caldera",
    "nodeCategory":"PERMISSIVE",
    "nodelicenses":[
        {"identifier":"Caldera"}
    ]
}                           
                                </pre>
                        </h4>
                    </div>
                    <div class="col-md-4">
                        <h4>@Response</h4>
                        <h5>Content-Type : application/json</h5>
                        <h5>Format :<br> 
                                <pre>
{
    "status":"success",
    "message":"Caldera added in the system."
}                           
                                </pre>
                            or
                            <br>
                                <pre>
{
    "status":"failure",
    "message":"Caldera already exists."
}                           
                                </pre>
                        </h4>
                    </div>
                </div>   
            
            </div>
        </div>
    </div>

    <div class="panel panel-default">

        <div class="panel-heading" role="tab" id="addEdgeHeader">
            <h4 class="panel-title">
                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#addEdge" aria-expanded="false" aria-controls="addEdge">
                    Add a new edge between nodes to the graph
                </a>
            </h4>
        </div>
        <div id="addEdge" class="panel-collapse collapse" role="tabpanel" aria-labelledby="addEdgeHeader">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-4">
                        <h4>@Method</h4>
                        <h5>POST</h5>
                        </br>
                        <h4>@Path</h4>
                        <h5>/license/edge/</h5>   
                        </br>
                        <h4>@Info</h4>
                        <h5>-</h5>
                    </div>
                    <div class="col-md-4">
                        <h4>@Request</h4>
                        <h5>Content-Type : application/json</h5>
                        <h5>Format :<br> 
                                <pre>
{
    "nodeIdentifier":"Caldera",
    "transitivity":"true",
    "nodeIdentifiers":[
        {"identifier":"Apache-2.0"}
    ]
}                           
                                </pre>
                        </h4>
                    </div>
                    <div class="col-md-4">
                        <h4>@Response</h4>
                        <h5>Content-Type : application/json</h5>
                        <h5>Format :<br> 
                                <pre>
{
    "status":"success",
    "message":"Caldera -> Apache-2.0 added in the system."
}                           
                                </pre>
                            or
                            <br>
                                <pre>
{
    "status":"failure",
    "message":"Caldera -> Apache-2.0 already exists."
}                           
                                </pre>
                        </h4>
                    </div>
                </div> 
            </div>
        </div>

    </div>
</div>