<?php //pre($_SESSION,1);?>
<div class="content-page text-dark">
    <?php //Start content ?>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">
                        <h4 class="page-title">AC wise Coverage</h4>
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
                                                <th style="text-align: center;" class="tw5">SL NO.</th>
                                                <th style="text-align: center;" class="tw5">AC NO.</th>
                                                <th style="text-align: center;" class="tw5">SECTOR NO.</th>
                                                <th style="text-align: center;" class="tw5">TOTAL PREMISES</th>
                                                <th style="text-align: center;" class="tw5">TOTAL BOOTH</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($acData as $key => $ac){ ?>
                                            <tr>
                                                <td style="text-align: center;" class="tw5"><?php echo $key+1; ?></td>
                                                <td style="text-align: center;" class="tw5"><?php echo $ac['AC'];?></td>
                                                <td style="text-align: center;" class="tw5"><?php echo $ac['SECTORNO'];?></td>
                                                <td style="text-align: center;" class="tw5"><?php echo $ac['TOTPREMISES'];?></td>
                                                <td style="text-align: center;" class="tw5"><?php echo $ac['TOTBOOTH'];?></td>
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