<?php //loader?>

<div id="loading" hidden style="margin-top: 5em; text-align: center; font-family: Verdana; font-size: 12px;"><img style="vertical-align: middle" src="loading.gif" /> loading Report. Please wait...</div>


<?php //file modal?>
  <div id="downmodal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content p-0 b-0">
                                                <div class="panel panel-color panel-primary">
                                                    <div class="panel-heading">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        <h3 class="panel-title">Download Files</h3>
                                                    </div>
                                                    <div  class="panel-body">
                                                        <span id="files_to_download"></span>
                                                        
                                                    </div>
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->


<?php //report selection Modal?>                                    


<div id="report_sel_modal" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    <h4 class="modal-title">Please Select the Report correspoding to this request !!!</h4>
                                                </div>
                                                <div class="modal-body" align="CENTER">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                        
                                        <label for="field-1" class="control-label">Report ID:-</label>
                                         <select class="select2"    name="RP_ID_SEL" id="RP_ID_SEL" required>
                                            <option selected="true" disabled="disabled" value="">Loading...</option>
                                            <!-- <option selected="true" disabled="disabled" value="">Select Report ID</option> -->
                                            <!-- <option value="Normal">Normal</option>
                                            <option value="Urgent">Urgent</option>
                                            <option value="Most Urgent">Most Urgent</option> -->
                             </select>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                   
                                                 
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                                    <button type="button" id="map_req2rep" class="btn btn-info waves-effect waves-light">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- /.modal -->