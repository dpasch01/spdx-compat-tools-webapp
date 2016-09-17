<div id="edge-modal"  class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 id="operation" class="modal-title"></h4>
            </div>
            
            <form id="edge-form" name='uploader' action="" method="post" class="form-horizontal">
                <fieldset>
                    
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="edge-from-input">From:</label>  
                            <div class="col-md-4">
                                <input disabled id="edge-from-input" name="edge-from-input" placeholder="" class="form-control input-md" required="" type="text">

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="edge-to-input">To:</label>  
                            <div class="col-md-4">
                                <input disabled id="edge-to-input" name="edge-to-input" placeholder="" class="form-control input-md" required="" type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="edge-types">Edge type:</label>
                            <div class="col-md-4">
                                <div class="radio">
                                    <label for="edge-types-0">
                                        <input name="edge-types" id="edge-types-0" value="TRANSITIVE" checked="checked" type="radio">
                                        Transitive
                                    </label>
                                </div>
                                <div class="radio">
                                    <label for="edge-types-1">
                                        <input name="edge-types" id="edge-types-1" value="NON_TRANSITIVE" type="radio">
                                        Non-Transitive
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <div class="modal-footer">
                        <div class="form-group">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Connect</button>
                        </div>
                    </div>
                </fieldset>
            </form>
            
        </div>
    </div>
</div>