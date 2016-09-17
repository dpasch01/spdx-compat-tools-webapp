<div class="container">
    
    <div class="intro jumbotron">
        <h1>SPDX License Validation Tool</h1>
        <p><i>Upload your Software Package Data Exchange (SPDX) files to validate each one for license compatibilities, and also analyze their compatibility among the files. If a conflict exists between the declared licenses and an adjustment is feasible, you will receive one or more license suggestions for the software package.</i></p>
        <form type="post" id="spdx-uploader" action="" enctype="multipart/form-data">
            <div class="form-group">
                <input id="spdx-files" name="spdx-files[]" type="file" class="file" multiple=true data-preview-file-type="text">
            </div>
        </form>
        <div class="text-center"><img id="loading" src="_/img/loader.gif"/></div>
    </div>
    
    <div class="result hidden jumbotron">
        <span><a class="refresh-btn" href="#"><i class="pull-right fa fa-chevron-circle-left fa-4x"></i></a></span>
        <h1 class="result-title"></h1>
        <div class="result-content"></div>
        <ul class="file-list list-group"></ul>
        <div class="text-center"><img id="loading" src="_/img/loader.gif"/></div>
        <div class="color-holder">
            <i class="white fa fa-circle "></i> Success: Valid SPDX file<br>
            <i class="yellow fa fa-circle "></i> Warning: Concluded license not found<br>
            <i class="error-font fa fa-circle "></i> Error: License compatibility conflict
        </div>
    </div>
    
</div>