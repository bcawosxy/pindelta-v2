@extends('layout.admin.master')

@section('head')
    @include('layout.admin.head')
@endsection

@section('header')
    @include('layout.admin.header')
@endsection

@section('navbar')
    @include('layout.admin.navbar')
@endsection

@section('content')
<div class="content-wrapper" style="height: auto;">
    <section class="content col-lg-11">
        <div class="box">
            <div class="box-header with-border">
                <h3>
                    類別 / 項目 / 產品 / 瀏覽人數 逐周統計數量
                </h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div id="container" style="height: auto; margin: 0 auto;width:95%;"></div>
                </div>
            </div>
            <hr>
            <div class="box-header with-border">
                <h3>
                    各類別下的項目 / 產品數量
                </h3>
            </div>
            <div class="box-body">
                <div class="row">
					<?php
					foreach ($data['series_pie'] as $k0 => $v0) {
						echo '<div class="col-md-2" style="margin:10px 0;" >
									<div id="container_'.$v0['categoryarea_id'].'" style="height: 300px; margin: 0 auto"></div>
								</div>';
					}
					?>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection()

@section('foot')
<script src="{{ URL::asset('adminlte/plugins/highcharts/js/highcharts.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('adminlte/plugins/highcharts/js/exporting.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('adminlte/plugins/highcharts/js/sand-signika.js')}}" type="text/javascript"></script>

<script type="text/javascript">
    $(function () {
        $('#container').highcharts({
        chart: {
            zoomType: 'xy'
            },
            title: {
            text: 'Pindelta.com'
            },
            subtitle: {
            text: 'Count by weekly'
            },
            xAxis: [{
            categories: [<?php echo implode(',', $data['chart_categories'])?>],
            crosshair: true
            }],
            yAxis: [{
                labels: {
                format: '{value}',
                style: {
                color: Highcharts.getOptions().colors[1]
                }
                },
                title: {
                text: 'Count',
                style: {
                color: Highcharts.getOptions().colors[1]
                }
                }
            }, {
                labels: {
                format: '{value}',
                style: {
                color: Highcharts.getOptions().colors[0]
                },
                },
                title: {
                text: 'Viewed',
                style: {
                color: Highcharts.getOptions().colors[0]
                }
                },
                tickInterval : 20,
                opposite: true
            }],
            plotOptions: {
                spline: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: true
                }
            },
            tooltip: {
                shared: true
            },
            legend: {
                layout: 'vertical',
                align: 'left',
                x: 80,
                verticalAlign: 'top',
                y: 0,
                floating: true,
                backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
            },
            series: [
                {
                    name: 'Viewed',
                    type: 'column',
                    yAxis: 1,
                    data: [<?php echo implode(',' ,$data['data_viwed']); ?>],
                },
                <?php
                foreach ($data['series_line'] as $k0 => $v0) {
                    echo '{name:"'.$v0['name'].'", data : ['.$v0['data'].'], type : \'spline\'},' ;
                }
                ?>
            ]
        });

        // Build the Pie chart
        <?php
            foreach ($data['series_pie'] as $k0 => $v0) {
                echo '$(\'#container_'.$v0['categoryarea_id'].'\').highcharts({
                    chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false,
                        type: \'pie\'
                    },
                    title: {
                        text: \''.$v0['categoryarea_name'].'\'
                    },
                    subtitle: {
                        text: \'Category : '.$v0['category_num'].' <br /> Product : '.$v0['product_num'].'\',
                    },
                    tooltip: {
                       formatter: function() {
                            return \'<b>\' + this.point.name + \'</b><br />Total: \' +Highcharts.numberFormat(this.y, 0) + \'<br />\'  + Highcharts.numberFormat(this.percentage, 1) + \'%\';
                        }

                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: \'pointer\',
                            dataLabels: {
                                enabled: false
                            },
                            showInLegend: true
                        },
                    },
                    series: [{
                        name: \'Brands\',
                        colorByPoint: true,
                        data: ['.$v0['data'].']
                    }]
                });';
            };
        ?>

        $('.content-wrapper').css('min-height', 3000);
    });
</script>
@endsection