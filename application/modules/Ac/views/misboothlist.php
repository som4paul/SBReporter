<?php //pre($_SESSION,1);?>
<div class="content-page text-dark">
    <?php //Start content ?>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">
                        <h4 class="page-title">AC wise Missing Booth List Report</h4>
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
                                                <th style="text-align: center;" class="tw5">AC</th>
                                                <th style="text-align: center;" class="tw5">BOOTH NO.</th>
                                            </tr>
                                        </thead>
                                        <tbody class="mislist">
                                            <?php foreach($misbooth_data as $value){?>
                                                <td><?php echo $value['AC']?></td>
                                                <td><?php echo $value['BOOTHNO']?></td>
                                            <?php }?>
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