<?php //pre($_SESSION,1);?>
<div class="content-page text-dark">
    <?php //Start content ?>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">
                        <h4 class="page-title">AC wise Coverage Report</h4>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row" id="psaccovlist">
                        <div class="col-xs-12">
                            <div class="card-box table-responsive">
                                <table id="datatable" class="table table-striped table-colored table-inverse">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;" class="tw5">PS NAME</th>
                                            <th style="text-align: center;" class="tw5">AC NAME</th>
                                            <th style="text-align: center;" class="tw5">PC NAME</th>
                                            <th style="text-align: center;" class="tw5">PREMISES</th>
                                            <th style="text-align: center;" class="tw5">BOOTHS</th>
                                        </tr>
                                    </thead>
                                    <tbody class="accovlist">
                                        <?php echo $html;?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <?php //container ?>
</div> <?php //content ?>
<?php $this->load->view('includes/contentFooter'); ?>