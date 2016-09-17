<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel panel-default">

        <div class="panel-heading" role="tab" id="licenseHeader">
            <h4 class="panel-title">
                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#license" aria-expanded="false" aria-controls="license">
                    Check compatibility between two or more licenses
                </a>
            </h4>
        </div>
        <div id="license" class="panel-collapse collapse" role="tabpanel" aria-labelledby="licenseHeader">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-4">
                        <h4>@Method</h4>
                        <h5>POST</h5>
                        <br>
                        <h4>@Path</h4>
                        <h5>/license/compatible/</h5>
                        <br>
                        <h4>@Info</h4>
                        <h5>-</h5>
                    </div>
                    <div class="col-md-4">
                        <h4>@Request</h4>
                        <h5>Content-Type : application/json</h5>
                        <h5>Format :<br> 
                                <pre>
{"licenses":[
    {"identifier":"Apache-2.0"},
    {"identifier":"MPL-2.0"}
    ]
}                               </pre>
                        </h4>
                    </div>
                    <div class="col-md-4">
                        <h4>@Response</h4>
                        <h5>Content-Type : application/json</h5>
                        <h5>Format :<br> 
                                <pre>
{
    "compatible": "true"
    "adjustable": "false"
    "proposals": [0]
}                              </pre>
                        </h4>
                    </div>
                </div>                
            </div>
        </div>

    </div>
    <div class="panel panel-default">

        <div class="panel-heading" role="tab" id="licensesHeader">
            <h4 class="panel-title">
                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#licenses" aria-expanded="false" aria-controls="licenses">
                    Recieves a JSON with the identifiers of all the licenses in the graph
                </a>
            </h4>
        </div>
        <div id="licenses" class="panel-collapse collapse" role="tabpanel" aria-labelledby="licensesHeader">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <h4>@Method</h4>
                        <h5>GET</h5>
                        <br>
                        <h4>@Path</h4>
                        <h5>/license/licenses/</h5>
                        <br>
                        <h4>@Info</h4>
                        <h5>This api call returns all the licenses that are contained inside the system's graph. It is used in the representation of the licenses in the side panel of the graph, but can be used in an attempt to search a specific license.</h5>
                    </div>
                    <div class="col-md-6">
                        <h4>@Response</h4>
                        <h5>Content-Type : application/json</h5>
                        <h5>Format :<br> 
                            <pre>
{
    "licenses": [
        {
            "identifier": "Zlib"
        },
        {
            "identifier": "BSD-3-Clause"
        },
        {
            "identifier": "MPL-2.0"
        }
    ]
}
                            </pre>
                        </h4>
                    </div>
                </div>                
            </div>
        </div>

    </div>
</div>