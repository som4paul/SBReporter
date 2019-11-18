<?php //pre($_SESSION,1);?>
<div class="content-page text-dark">
    <?php //Start content ?>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">
                        <h4 class="page-title">PC wise DIVISION wise 1B-2B Report</h4>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-border panel-teal hi150">
                        <div class="panel-heading">
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <select class="form-control pcidfordiv">
                                        <option>Select PC</option>
                                        <?php foreach($pc_data as $val){ ?>
                                            <option value="<?php echo $val['PCNO'];?>"><?php echo $val['PCNAME']?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div><br><br><br><br>
                        <div class="row" id="pcdivlist">
                            <div class="col-xs-12">
                                <div class="card-box table-responsive">
                                    <table id="datatable" class="table table-striped table-colored table-inverse">
                                        <thead>
                                            <tr>
                                                <th align="center" style="font-size: 12px" class="tw5">DIV NAME</th>
                                                <th align="center" style="font-size: 12px" class="tw5">PS NAME</th>
                                                <th align="center" style="font-size: 12px" class="tw5">1-B</th>
                                                <th align="center" style="font-size: 12px" class="tw5">2-B</th>
                                                <th align="center" style="font-size: 12px" class="tw5">3-B</th>
                                                <th align="center" style="font-size: 12px" class="tw5">4-B</th>
                                                <th align="center" style="font-size: 12px" class="tw5">5-B</th>
                                                <th align="center" style="font-size: 12px" class="tw5">6-B</th>
                                                <th align="center" style="font-size: 12px" class="tw5">7-B</th>
                                                <th align="center" style="font-size: 12px" class="tw5">8-B</th>
                                                <th align="center" style="font-size: 12px" class="tw5">9-B</th>
                                                <th align="center" style="font-size: 12px" class="tw5">10-B</th>
                                                <th align="center" style="font-size: 12px" class="tw5">11-B</th>
                                                <th align="center" style="font-size: 12px" class="tw5">14-B</th>
                                                <th align="center" style="font-size: 12px" class="tw5">Booths</th>
                                                <th align="center" style="font-size: 12px" class="tw5">Premises</th>
                                                <th align="center" style="font-size: 12px" class="tw5">Aux. Booths</th>
                                                <th align="center" style="font-size: 12px" class="tw5">Hypercritical</th>
                                                <th align="center" style="font-size: 12px" class="tw5">Critical</th>
                                                <th align="center" style="font-size: 12px" class="tw5">Normal</th>
                                                <th align="center" style="font-size: 12px" class="tw5">W/Pol Stn.</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divlist">
                                            
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