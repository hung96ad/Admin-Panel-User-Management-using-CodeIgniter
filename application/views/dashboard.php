<!-- DataTables -->
<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Data Table With Full Features</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                                    <thead>
                                    <tr role="row">
                                        <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 2%;">ID</th>
                                        <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 5%px;">Symbol</th>
                                        <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 10%px;">% Change Predict</th>
                                        <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 10%px;">% Predict/Actual</th>
                                        <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 10%px;" >% Predict/Actual Last</th>
                                        <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 10%px;" >% Change Actual</th>
                                        <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 10%px;" >Price Predict System</th>
                                        <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 10%px;" >Price Suggest</th>
                                        <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 10%px;" >Time Predict</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($datatable as $item){
                                        echo '<tr role="row" class="odd">';
                                        echo '<td class="">' . $item->id_coin . '</td>';
                                        echo '<td class=""> <a href="' . base_url() . 'chart/' . $item->symbol . '" ><span>' . $item->symbol . '</span></a></td>';
                                        echo '<td class="">' . $item->percent_predict . '</td>';
                                        echo '<td class="">' . $item->percent_predict_actual . '</td>';
                                        echo '<td class="">' . $item->percent_predict_actual_last . '</td>';
                                        echo '<td class="">' . $item->percent_actual . '</td>';
                                        echo '<td class="">' . $item->price_preidct_last . '</td>';
                                        echo '<td class="">' . $item->price_preidct_true . '</td>';
                                        echo '<td class="">' . $item->time_predict . '</td>';

                                    } ?>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </section>
</div>

<!-- DataTables -->
<script src="<?php echo base_url(); ?>/assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script>
    $(function () {
        $('#example1').DataTable( {
            "order": [[ 2, "desc" ]]
        })
    })
</script>
