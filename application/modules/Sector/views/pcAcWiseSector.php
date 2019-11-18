<?php //pre($_SESSION,1);?>
<div class="content-page text-dark">
    <?php //Start content ?>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">
                        <h4 class="page-title">PC AC wise Sector</h4>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-border panel-teal hi150">
                        <div class="panel-heading">
                        </div>
                        <div class="row" id="psmislist">
                            <div class="col-xs-12">
                                <div class="card-box table-responsive">
                                    <table id="datatable" class="table table-striped table-colored table-inverse">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center;" class="tw5">PCNAME</th>
                                                <th style="text-align: center;" class="tw5">ACNAME</th>
                                                <th style="text-align: center;" class="tw5">NO. OF SECTOR</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $i=0;
                                                $lastname = '';
                                                foreach($pcAcData as $pcac){
                                                    if($pcac['PCNAME'] == $lastname){
                                                        $pcnm = '';
                                                    }else{
                                                        $pcnm = $pcac['PCNAME'];
                                                    }
                                            ?>
                                            <tr>
                                                <td class="tw5">
                                                    <?php echo $pcnm; ?></td>
                                                <td class="tw5"><?php echo $pcac['ACNAME'];?></td>
                                                <td style="text-align: center;" class="tw5"><?php echo $pcac['NO_OF_SECTORS'];?></td>
                                            </tr>
                                            <?php 
                                                $lastname = $pcac['PCNAME'];
                                                } 
                                            ?>
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
<?php $this->load->view('includes/contentFooter'); ?>