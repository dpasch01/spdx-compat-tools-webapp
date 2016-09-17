<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-capable" content="yes">
        
        <title>License Compatibility Graph</title>
        
        <link href="_/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="_/libs/vis/dist/vis.min.css" rel="stylesheet">
        <link href="_/libs/bootstrap-multiselect/dist/css/bootstrap-multiselect.css" rel="stylesheet">
        <link href="_/libs/sweetalert/lib/sweet-alert.css" rel="stylesheet">
        <link href="_/css/default.css" rel="stylesheet">
        <link href="_/css/graph.css" rel="stylesheet">
        
        <link rel="icon" type="image/ico" href="_/img/favicon.ico">
        <link rel="apple-touch-icon" href="_/img/apple-icon-114x114-precomposed.png" />
    </head>
    <body>
    
        <?php include 'components/navbar.php'; ?>
        <?php include 'components/graph/connect.php'; ?>
        <?php include 'components/graph/popup.php'; ?>
                
        <div class="container">
            <div id="loading" class="hidden vertical-center"><img src="_/img/loader.gif"/></div>
            <div id="graph-content" class="hidden row">
                <div class="col-md-8">
                    <div id="mynetwork"></div>
                </div>
                <div class="col-md-4">
                    <?php include'components/graph/licenses.php'; ?>
                </div>
            </div>
        </div>
        
        <div id="server-error" class="vertical-center hidden container">
            <div class="jumbotron">
                <br>
                <h1 class="text-center">We're sorry!</h1>
                <p class="text-center">The server is currently unavailable.</p>
            </div>
        </div>
        
        <div class="hidden" id="web-container"></div>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="_/libs/bootstrap/js/bootstrap.min.js"></script>
        <script src="_/libs/vis/dist/vis.min.js"></script>
        <script src="_/libs/bootstrap-multiselect/dist/js/bootstrap-multiselect.js"></script>
        <script src="_/libs/sweetalert/lib/sweet-alert.min.js"></script>
        <script src="_/js/graph.js"></script>
        
    </body>
    
</html>