<!-- Morris charts -->
<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/bower_components/morris.js/morris.css">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-bar-chart"></i> Chart <?php echo $symbol;?>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Price: <?php echo $price;?></h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body chart-responsive">
                        <div class="chart" id="line-chart" style="height: 500px;">
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Morris.js charts -->
<script src="<?php echo base_url(); ?>assets/bower_components/raphael/raphael.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/morris.js/morris.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url(); ?>assets/bower_components/fastclick/lib/fastclick.js"></script>
<script>
    $(function () {
        "use strict";
        // AREA CHART
        var line = new Morris.Line({
            element: 'line-chart',
            resize: true,
            data: [
                <?php $len = count($price_actual);
                echo  '{y: '. $openTime_last .', price_actual: '. $price_actual[0] . ', price_predict: null},';
                for($i = 2; $i< $len-1 ; $i++){
                    $time = ($i * 30 * 60 * 1000 + $openTime_last);
                    echo  '{y: '. $time . ', price_actual: '. $price_actual[$i-1] . ', price_predict: ' . $price_predict[$i] . '},';
                }
                $time = (($len - 1) * 30 * 60 * 1000 + $openTime_last);
                echo  '{y: ' . $time . ', price_actual: null , price_predict: ' . $price_predict[$len-1] . '},';
                ?>
            ],
            xkey: 'y',
            ykeys: ['price_actual', 'price_predict'],
            ymin: 'auto',
            labels: ['Actual', 'Predict'],
            lineColors: ['#a0d0e0', '#f45f42'],
            hideHover: 'auto'
        });
    });
</script>
