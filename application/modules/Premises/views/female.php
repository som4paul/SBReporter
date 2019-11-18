<?php //pre($_SESSION,1);?>
<div class="content-page text-dark">
    <?php //Start content ?>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Female Premises Report</h4>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <!-- <div class="panel panel-border panel-teal hi150"> -->
                        <div class="row" id="prefemale">
                            <div class="col-xs-12">
                                <div class="card-box table-responsive">
                                    <table id="datatable" class="table table-striped table-colored table-inverse">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center;" class="tw5">PS NAME</th>
                                                <th style="text-align: center;" class="tw5">1-B</th>
                                                <th style="text-align: center;" class="tw5">2-B</th>
                                                <th style="text-align: center;" class="tw5">3-B</th>
                                                <th style="text-align: center;" class="tw5">4-B</th>
                                                <th style="text-align: center;" class="tw5">5-B</th>
                                                <th style="text-align: center;" class="tw5">6-B</th>
                                                <th style="text-align: center;" class="tw5">7-B</th>
                                                <th style="text-align: center;" class="tw5">8-B</th>
                                                <th style="text-align: center;" class="tw5">9-B</th>
                                                <th style="text-align: center;" class="tw5">10-B</th>
                                                <th style="text-align: center;" class="tw5">14-B</th>
                                                <th align="center" style="font-size: 12px" class="tw5">Booths</th>
                                                <th align="center" style="font-size: 12px" class="tw5">Premises</th>
                                                <th align="center" style="font-size: 12px" class="tw5">Aux. Booths</th>
                                                <th align="center" style="font-size: 12px" class="tw5">Hypercritical</th>
                                                <th align="center" style="font-size: 12px" class="tw5">Critical</th>
                                                <th align="center" style="font-size: 12px" class="tw5">Normal</th>
                                            </tr>
                                        </thead>
                                        <tbody class="psprelist">
                                            <?php echo $html;?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <!-- </div> -->
                </div>
            </div>
        </div>
    </div> <?php //container ?>
</div> <?php //content ?>
<?php $this->load->view('includes/contentFooter'); ?>