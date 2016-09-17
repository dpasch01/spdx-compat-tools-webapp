<div id="modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 id="operation" class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">
                    <fieldset>
                        <div class="hidden form-group">
                            <label class="col-md-4 control-label" for="node-id">ID:</label>  
                            <div class="col-md-4">
                                <input id="node-id" name="node-id"  disabled placeholder="Identifier" class="form-control input-md" required="" type="text">
                            </div>
                        </div>

                        <div class="hidden form-group">
                            <label class="col-md-4 control-label" for="node-label">Node Label:</label>  
                            <div class="col-md-4">
                                <input id="node-label" name="node-label" placeholder="Node label" class="form-control input-md" required="" type="text">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-4 control-label">Licenses</label>
                            <div class="col-md-4">
                                <select id="nodeLicenses" class="form-control" name="licenses" multiple>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="node-types">Node type:</label>
                            <div class="col-md-4">
                                <div class="radio">
                                    <label for="node-types-0">
                                        <input name="node-types" id="node-types-0" value="PERMISSIVE" checked="checked" type="radio">
                                        Permissive
                                    </label>
                                </div>
                                <div class="radio">
                                    <label for="node-types-1">
                                        <input name="node-types" id="node-types-1" value="WEAK_COPYLEFT" type="radio">
                                        Weak copyleft
                                    </label>
                                </div>
                                <div class="radio">
                                    <label for="node-types-2">
                                        <input name="node-types" id="node-types-2" value="STRONG_COPYLEFT" type="radio">
                                        Strong copyleft
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                    </fieldset>
                </form>
            </div>
            <div class="modal-footer">
                <button id="cancelButton" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button id="saveButton" type="button" class="btn btn-primary" data-dismiss="modal">Save changes</button>
            </div>
        </div>
    </div>
</div>

