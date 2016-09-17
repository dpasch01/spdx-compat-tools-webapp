<div id="correctSpdxModal" class="modal fade">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"></h4>
        </div>

            <form id="correct-form" name='correct-form' action="spdx/correct-spdx.php" method="post" class="form-horizontal">
                <fieldset>

                    <div class="modal-body">                        
                        <div class="form-group">
                            <label class="col-md-5 control-label" for="declaredLicense">License <a href="#" data-container="body" data-toggle="popover" title="Choose license" data-content="Choose a new license for this spdx file to be redeclared with. The licenses selection is derived from the proposals based on the conflicts."><i class="fa fa-question-circle"></i></a></label>
                            <div class="col-md-7">
                                <select id="declaredLicense" name="declaredLicense" class="form-control"></select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <div class="form-group">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Correct</button>
                        </div>
                    </div>
                    
                </fieldset>
            </form>

        </div>
    </div>
</div>
