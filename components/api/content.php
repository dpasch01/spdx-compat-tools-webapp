<div class="container">

    <div class="page-header">
        <h1>SPDX License Compatibility Tools API <small>Make yourself at home!</small></h1>
    </div>

    <div class="api-header row">
        <div class="col-md-12">
            <h2>SPDX Validation Analysis Services</h2>
            <p>Analyze and validate the declared licenses of your spdx files easily from our services.</p>
        </div>
    </div> 

    <div class="api-body row">
        <?php include'components/api/spdx.php' ?>     
    </div>

    <div class="api-header row">
        <div class="col-md-12">
            <h2>License Compatibility Services</h2>
            <p>Iterate our graph and check for compatibility issues between any licenses.</p>
        </div>
    </div> 

    <div class="api-body row">
        <?php include'components/api/compatibility.php' ?>     
    </div>


    <div class="api-header row">
        <div class="col-md-12">
            <h2>Graph Expansion Services</h2>
            <p>Help us expand the license compatibility graph, so we can help you.</p>
        </div>
    </div> 

    <div class="api-body row">
        <?php include'components/api/graph.php' ?>     
    </div>


</div>