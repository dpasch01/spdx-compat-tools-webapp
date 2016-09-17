<div class="container">
    <h1>About</h1>
    <div>
        <p>This application assumes the use of the <a href="http://spdx.org/">Software Package Data Exchange®</a> (SPDX®) specification which is a standard format for communicating the components, licenses and copyrights associated with a software package. It allows the user to combine multiple SPDX files (in .rdf) to see if each file is in the correct syntax and if the licenses included in the files are compatible with each other. The license compatibility detection is based on the license compatibility graph.</p>
    </div>
</div>	

<div class="container">
    <h1 id="learn-more">Implementation</h1>
    
    <div>
        <p>            
            This site is the result of the research work of the <a href="http://www.cs.ucy.ac.cy/">Department of Computer Science</a> of the <a href="http://www.ucy.ac.cy/en/">University of Cyprus</a> with the involvement of <a href="http://www.cs.ucy.ac.cy/~dpasch01/">Demetris Paschalides</a> and <a href="http://www.cs.ucy.ac.cy/~gkapi/">Dr. Georgia M. Kapitsaki</a>. After checking the syntax of the SPDX file,the application proceeds by validating the compatibility of the declared licenses of each file and afterwards the compatibility between the files used as input.
        </p>
    </div>
    
    <div>
        <p>            
            The compatibility is decided by traversing the compatibility graph of each license pair. The graph is created based on the OSS license graph that can be found in <a href="#publications">publication [1]</a> along with some changes performed . Arrows indicate that two licenses may be combined, and that the combined work can effectively be treated as having the license at the end of the arrow, possibly with some additional restrictions taken from the license at the start of the arrow.
        </p>
    </div>

    <div>
        <p>
        <center><img src="_/img/fig1_v2.png" class="img-thumbnail"></img></center>
        </p>

<h1 id="publications">Relevant publications</h1>
        
<p><b>[1]</b> Georgia M. Kapitsaki, Nikolaos D. Tselikas, Ioannis E. Foukarakis, An insight into license tools for open source software systems, Journal of Systems and Software, vol. 102, pp. 72–87, Apr. 2015.</p>
<p><b>[2]</b> Georgia M. Kapitsaki, Frederik Kramer, Open Source License Violation Check for SPDX Files, in Proceedings of the 14th International Conference on Software Reuse (ICSR 2015), pp. 90-105.</p>
<p><b>[3]</b> Ioannis E. Foukarakis, Georgia M. Kapitsaki, Nikolaos D. Tselikas Choosing licenses in free open source software, In Proceedings of the 24th International Conference on Software Engineering and Knowledge Engineering (SEKE 2012), pp. 200-204.</p>
    </div>
</div>