<?php //pre($_SESSION,1);?>
<div class="content-page text-dark">
    <?php //Start content ?>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">
                        <h4 class="page-title">AC wise 1B-2B Report</h4>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row" id="preaclist">
                        <div class="col-xs-12">
                            <div class="card-box table-responsive">
                                <table id="datatable" class="table table-striped table-colored table-inverse">
                                    <thead>
                                        <tr>
                                            <th align="center" class="tw5 f12">AC</th>
                                            <th align="center" class="tw5 f12">1-B</th>
                                            <th align="center" class="tw5 f12">2-B</th>
                                            <th align="center" class="tw5 f12">3-B</th>
                                            <th align="center" class="tw5 f12">4-B</th>
                                            <th align="center" class="tw5 f12">5-B</th>
                                            <th align="center" class="tw5 f12">6-B</th>
                                            <th align="center" class="tw5 f12">7-B</th>
                                            <th align="center" class="tw5 f12">8-B</th>
                                            <th align="center" class="tw5 f12">9-B</th>
                                            <th align="center" class="tw5 f12">10-B</th>
                                            <th align="center" class="tw5 f12">14-B</th>
                                            <th align="center" class="tw5 f12">Booths</th>
                                            <th align="center" class="tw5 f12">Premises</th>
                                            <th align="center" class="tw5 f12">Aux. Booths</th>
                                            <th align="center" class="tw5 f12">Hypercritical</th>
                                            <th align="center" class="tw5 f12">Critical</th>
                                            <th align="center" class="tw5 f12">Normal</th>
                                            <th align="center" class="tw5 f12">W/Pol Stn.</th>
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