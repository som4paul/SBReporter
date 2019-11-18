<div class="content-page">

    <div class="content">
        <div class="container">
            <div class="row m-t-20 m-b-20 hi150">
            	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="col-md-2">
                        <a href="<?php echo base_url();?>mccdashboard/details/<?php echo myEncode('Registered'); ?>/registered">
                            <div class="card-box widget-box-one widget-two-primary" align="center">
                                <div class="wigdet-one-content">
                                    <p class="m-0 text-uppercase font-600 font-secondary text-overflow text-dark">Registered</p>
                                    <h2 class="text-white"><span data-plugin="counterup"><?php echo $registered; ?></span></h2>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-2">
                        <a href="<?php echo base_url();?>mccdashboard/details/<?php echo myEncode('Forwarded'); ?>/forwarded">
                            <div class="card-box widget-box-one widget-two-warning" align="center">
                                <div class="wigdet-one-content">
                                    <p class="m-0 text-uppercase font-600 font-secondary text-overflow text-dark">forwarded</p>
                                    <h2 class="text-white"><span data-plugin="counterup"><?php echo $forwarded; ?></span></h2>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-2">
                        <a href="<?php echo base_url();?>mccdashboard/details/<?php echo myEncode('FWD. Pending'); ?>/fwdpending">
                            <div class="card-box widget-box-one widget-two-danger" align="center">
                                <div class="wigdet-one-content">
                                    <p class="m-0 text-uppercase font-600 font-secondary text-overflow text-dark">FWD. Pending</p>
                                    <h2 class="text-white"><span data-plugin="counterup"><?php echo $forwarded_pending; ?></span></h2>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-2">
                        <a href="<?php echo base_url();?>mccdashboard/details/<?php echo myEncode('RPT. Received'); ?>/rptreceived">
                            <div class="card-box widget-box-one widget-two-success" align="center">
                                <div class="wigdet-one-content">
                                    <p class="m-0 text-uppercase font-600 font-secondary text-overflow text-dark">RPT. Received</p>
                                    <h2 class="text-white"><span data-plugin="counterup"><?php echo $report_received; ?></span></h2>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-2">
                        <a href="<?php echo base_url();?>mccdashboard/details/<?php echo myEncode('Disposed'); ?>/disposed">
                            <div class="card-box widget-box-one widget-two-brown" align="center">
                                <div class="wigdet-one-content">
                                    <p class="m-0 text-uppercase font-600 font-secondary text-overflow text-dark">disposed</p>
                                    <h2 class="text-white"><span data-plugin="counterup"><?php echo $disposed; ?></span></h2>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-2">
                        <a href="<?php echo base_url();?>mccdashboard/details/<?php echo myEncode('Total Pending'); ?>/totalpending">
                            <div class="card-box widget-box-one" style="background-color: red;" align="center">
                                <div class="wigdet-one-content">
                                    <p class="m-0 text-uppercase font-600 font-secondary text-overflow text-dark">Total pending</p>
                                    <h2 class="text-white"><span data-plugin="counterup"><?php echo $pending; ?></span></h2>
                                </div>
                            </div>
                        </a>
                    </div>
            	</div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="demo-box m-t-20">
                            <h4 class="m-t-0 header-title"><b>Nature Of Complaints</b></h4>
                            <div class="table-responsive">
                                <table class="table table-colored table-info">
                                    <thead>
                                        <tr align="center">
                                            <th>Nature</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($compnature as $key => $value) { ?>
                                        <tr>

                                            <td><?php if($value['COMPLAINT_NATURE'] == "Total"){echo "<b>".$value['COMPLAINT_NATURE']."</b>";}else{ echo '<a href="'.base_url().'mccdashboard/details/'.myEncode($value['COMPLAINT_NATURE']).'/'.'nature">'.$value['COMPLAINT_NATURE'].'</a>';} ?></td>
                                            <td align="center">
                                                <?php if($value['COMPLAINT_NATURE'] == "Total"){echo "<b>".$value['CNT']."</b>";}else{ echo $value['CNT'];} ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="demo-box m-t-20">
                            <h4 class="m-t-0 header-title"><b>Mode Of Complaints</b></h4>
                            <div class="table-responsive">
                                <table class="table table-colored table-info">
                                    <thead>
                                        <tr>
                                            <th>Complaint Mode</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($compnaturemode as $key => $value) { ?>
                                        <tr>

                                            <td><?php if($value['COMPL_MODE'] == "Total"){echo "<b>".$value['COMPL_MODE']."</b>";}else{ echo '<a href="'.base_url().'mccdashboard/details/'.myEncode($value['COMPL_MODE']).'/'.'mode">'.$value['COMPL_MODE'].'</a>';} ?></td>
                                            <td align="center">
                                                <?php if($value['COMPL_MODE'] == "Total"){echo "<b>".$value['CNT']."</b>";}else{ echo $value['CNT'];} ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="demo-box m-t-20">
                            <h4 class="m-t-0 header-title"><b>Source Of Complaints</b></h4>
                            <div class="table-responsive">
                                <table class="table table-colored table-info">
                                    <thead>
                                        <tr>
                                            <th>Complaint Source</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($complaintsource as $key => $value) { ?>
                                        <tr>

                                            <td><?php if($value['COMPL_SOURCE'] == "Total"){echo "<b>".$value['COMPL_SOURCE']."</b>";}else{ echo '<a href="'.base_url().'mccdashboard/details/'.myEncode($value['COMPL_SOURCE']).'/'.'source">'.$value['COMPL_SOURCE'].'</a>';} ?></td>
                                            <td align="center">
                                                <?php if($value['COMPL_SOURCE'] == "Total"){echo "<b>".$value['CNT']."</b>";}else{ echo $value['CNT'];} ?></td>
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
</div>