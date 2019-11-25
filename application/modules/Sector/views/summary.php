<?php //pre($_SESSION,1);?>
<div class="content-page text-dark">
    <?php //Start content ?>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Summary</h4>
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
                                                <th style="text-align: center;" class="tw5">SECTOR NO.</th>
                                                <th style="text-align: center;" class="tw5">SECTOR NAME</th>
                                                <th style="text-align: center;" class="tw5">AC COVERED</th>
                                                <th style="text-align: center;" class="tw5">PS COVERED</th>
                                                <th style="text-align: center;" class="tw5">PREMISES COVERED</th>
                                                <th style="text-align: center;" class="tw5">BOOTHS COVERED</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                foreach($summData as $key => $summ){
                                                    $str = $summ['PS_COVD'];
                                                    if (preg_match('/,/', $str)){
                                                        $clr_row = "style=color:red;";
                                                    } else {
                                                        $clr_row = "";
                                                    }
                                            ?>
                                            <tr <?php echo $clr_row; ?>>
                                                <td class="tw5 text-center"><?php echo $summ['SNO'];?></td>
                                                <td class="tw5"><?php echo $summ['NAME'];?></td>
                                                <td class="tw5 text-center"><?php echo $summ['AC_COVD'];?></td>
                                                <td class="tw5 text-center"><?php echo $summ['PS_COVD'];?></td>
                                                <td class="tw5 text-center"><?php echo $summ['PREM_COVD'];?></td>
                                                <td class="tw5 text-center"><?php echo $summ['BOOTHS_COVD'];?></td>
                                            </tr>
                                            <?php } ?>
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