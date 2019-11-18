<?php //pre($_SESSION,1);?>
<div class="content-page text-dark">
    <?php //Start content ?>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">
                        <h4 class="page-title">DEO wise AC wise 1B-2B Report</h4>
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
                                    <select class="form-control deoidforac">
                                        <option>Select DEO</option>
                                        <?php foreach($deo_data as $val){ ?>
                                            <option value="<?php echo $val['DEOCODE'];?>"><?php echo $val['DEO']?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div><br><br><br><br>
                        <div class="row" id="deoaclist">
                            <div class="col-xs-12">
                                <div class="card-box table-responsive">
                                    <table id="datatable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th align="center" style="width: 6%;">AC</th>
                                                <th align="center" style="width: 3%;">1-B</th>
                                                <th align="center" style="width: 3%;">2-B</th>
                                                <th align="center" style="width: 3%;">3-B</th>
                                                <th align="center" style="width: 3%;">4-B</th>
                                                <th align="center" style="width: 3%;">5-B</th>
                                                <th align="center" style="width: 3%;">6-B</th>
                                                <th align="center" style="width: 3%;">7-B</th>
                                                <th align="center" style="width: 3%;">8-B</th>
                                                <th align="center" style="width: 3%;">9-B</th>
                                                <th align="center" style="width: 3%;">10-B</th>
                                                <th align="center" style="width: 3%;">11-B</th>
                                                <th align="center" style="width: 3%;">14-B</th>
                                                <th align="center" style="width: 8%;">Booths</th>
                                                <th align="center" style="width: 7%;">Premises</th>
                                                <th align="center" style="width: 8%;">Aux. Booths</th>
                                                <th align="center" style="width: 12%;">Hyper<br>critical</th>
                                                <th align="center" style="width: 6%;">Critical</th>
                                                <th align="center" style="width: 7%;">Normal</th>
                                                <th align="center" style="width: 8%;">W/Pol Stn.</th>
                                            </tr>
                                        </thead>
                                        <tbody class="dlist">
                                            
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