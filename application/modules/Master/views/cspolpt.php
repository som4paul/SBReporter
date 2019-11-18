<?php //pre($_SESSION,1);?>
<div class="content-page text-dark">
    <?php //Start content ?>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Political Parties </h4>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-border panel-teal hi150">
                        <div class="panel-heading">
                          <div class="text-right">
                            <a href="#"><button class="btn btn-primary btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#addpolptmodal"><i class="fa fa-plus"></i> Add New </button></a>
                          </div>
                          <br>
                        </div>
                       
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="card-box table-responsive">
                                    <table id="datatable" class="table table-striped table-colored table-teal">
                                        <thead>
                                            <tr>
                                                <th class="text-center" >SL.NO.</th>
                                                <th class="text-center">Political Party</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php foreach($allDetails as $key => $val){ ?> 
                                           <tr>
                                              <td class="text-center">
                                                  <?php echo ($key+1);  ?>
                                                    
                                              </td>
                                               <td class="text-center">
                                                   <?php echo $val['PARTY_NAME']; } ?>  
                                                </td>
                                                
                                                  
                                           </tr>
                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <?php //container ?>
</div> <?php //content ?>

<?php $this->load->view('includes/modals'); ?>

<?php $this->load->view('includes/contentFooter'); ?>