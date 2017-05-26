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
    categories: [],
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
            data: [],
        },
    ]
});

$('.content-wrapper').css('min-height', 10000);
});
</script>
@endsection