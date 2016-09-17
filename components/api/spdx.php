<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel panel-default">

        <div class="panel-heading" role="tab" id="validateHeader">
            <h4 class="panel-title">
                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#validate" aria-expanded="false" aria-controls="validate">
                    Validate single .spdx or .rdf file
                </a>
            </h4>
        </div>
        <div id="validate" class="panel-collapse collapse" role="tabpanel" aria-labelledby="validateHeader">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-4">
                        <h4>@Method</h4>
                        <h5>POST</h5>
                        </br>
                        <h4>@Path</h4>
                        <h5>/spdx/validate/</h5>   
                        </br>
                        <h4>@Info</h4>
                        <h5>Content must be escaped from xml special characters and removed of any new lines. Also the filename must be without the .spdx or .rdf extension.</h5>
                    </div>
                    <div class="col-md-4">
                        <h4>@Request</h4>
                        <h5>Content-Type : application/json</h5>
                        <h5>Format :<br> 
                                <pre>
{
    "filename":"example",
    "content":"&amp;lt;rdf:RDF..&amp;gt;&amp;lt;/rdf:RDF&amp;gt;"
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
    "file": "example9452345943243"
    "declared": [
        {"identifier": "MIT"},
        {"identifier": "MPL-2.0"},
    ],
    "compatible": "true",
    "adjustable": "true",
    "proposals": [0]
}                              </pre>
                        </h4>
                    </div>
                </div>   
            
            </div>
        </div>

    </div>
    <div class="panel panel-default">

        <div class="panel-heading" role="tab" id="analyzeHeader">
            <h4 class="panel-title">
                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#analyze" aria-expanded="false" aria-controls="analyze">
                    Validate one or more files and check their declared license compatibility
                </a>
            </h4>
        </div>
        <div id="analyze" class="panel-collapse collapse" role="tabpanel" aria-labelledby="analyzeHeader">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-4">
                        <h4>@Method</h4>
                        <h5>POST</h5>
                        </br>
                        <h4>@Path</h4>
                        <h5>/spdx/analyze/</h5>   
                        </br>
                        <h4>@Info</h4>
                        <h5>Content must be escaped from xml special characters and removed of any new lines. Also the filename must be without the .spdx or .rdf extension.</h5>
                    </div>
                    <div class="col-md-4">
                        <h4>@Request</h4>
                        <h5>Content-Type : application/json</h5>
                        <h5>Format :<br> 
                                <pre>
                                
{
    "count": "2",
    "files": [
        { 
            "filename":"example1",
            "content":"&amp;lt;rdf:RDF..&amp;gt;&amp;lt;/rdf:RDF&amp;gt;"
        },{ 
            "filename":"example2",
            "content":"&amp;lt;rdf:RDF..&amp;gt;&amp;lt;/rdf:RDF&amp;gt;"
        }
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
{   "unaries": [
    {
        "file": "example19452345943243"
        "declared": [
            {"identifier": "MIT"},
            {"identifier": "MPL-2.0"},
        ],
        "compatible": "true",
        "adjustable": "true",
        "proposals": [0]
    },{
        "file": "example2945765473243"
        "declared": [
            {"identifier": "MPL-2.0"},
        ],
        "compatible": "true",
        "adjustable": "true",
        "proposals": [0]
    }   
    ],
    "violation": "false",
    "asjustable": "true",
    "proposals": [0]
}
                                </pre>
                        </h4>
                    </div>
                </div>   
            </div>
        </div>

    </div>
    <div class="panel panel-default">

        <div class="panel-heading" role="tab" id="correctHeader">
            <h4 class="panel-title">
                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#correct" aria-expanded="false" aria-controls="correct">
                    Correct a file with a proposed license and recieve its content
                </a>
            </h4>
        </div>
        <div id="correct" class="panel-collapse collapse" role="tabpanel" aria-labelledby="correctHeader">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-4">
                        <h4>@Method</h4>
                        <h5>POST</h5>
                        </br>
                        <h4>@Path</h4>
                        <h5>/spdx/correct/</h5>   
                        </br>
                        <h4>@Info</h4>
                        <h5>Content must be escaped from xml special characters and removed of any new lines. Also the filename must be without the .spdx or .rdf extension.<br>The <i>"declared"</i> field corresponds to the new license for the file to be declared with.</h5>
                    </div>
                    <div class="col-md-4">
                        <h4>@Request</h4>
                        <h5>Content-Type : application/json</h5>
                        <h5>Format :<br> 
                                <pre>
{
    "filename":"example",
    "declared":"Apache-2.0",
    "content":"&amp;lt;rdf:RDF..&amp;gt;&amp;lt;/rdf:RDF&amp;gt;"
}                             
                                </pre>
                        </h4>
                    </div>
                    <div class="col-md-4">
                        <h4>@Response</h4>
                        <h5>Content-Type : text/xml</h5>
                        <h5>Format :<br> 
                                <pre>
&lt;rdf:RDF..&gt;
...
&lt;/rdf:RDF&gt;                        
                                </pre>
                        </h4>
                    </div>
                </div>   
            </div>
        </div>

    </div>
    <div class="panel panel-default">

        <div class="panel-heading" role="tab" id="downloadHeader">
            <h4 class="panel-title">
                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#download" aria-expanded="false" aria-controls="download">
                    Download the last corrected file
                </a>
            </h4>
        </div>
        <div id="download" class="panel-collapse collapse" role="tabpanel" aria-labelledby="downloadHeader">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-4">
                        <h4>@Method</h4>
                        <h5>GET</h5>
                    </div>
                    <div class="col-md-4">
                        <h4>@Path</h4>
                        <h5>/spdx/download/</h5>   
                    </div>
                    <div class="col-md-4">
                        <h4>@Info</h4>
                        <h5>The system response with the latest corrected spdx file.</h5>
                    </div>
                </div>  
            </div>
        </div>

    </div>
</div>