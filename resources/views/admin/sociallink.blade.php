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

    <section class="content-header">
        <div class="box-body">
            <h2 style="font-family: 'Source Sans Pro',sans-serif;font-size: 30px;margin-top: 20px; margin-bottom: 10px;font-weight: 500; line-height: 1.1;color: inherit;">
                社群網站連結
            </h2>
        </div>
        <h1>
            <small><p class="text-light-blue"></p></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">社群網站連結</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-10">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">社群網站連結清單</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th style="width: 15%">名稱</th>
                                <th style="width: 30%">連結</th>
                                <th style="width: 8%">排序</th>
                                <th style="width: 10%">顯示狀態</th>
                                <th>修改時間</th>
                            </tr>
                            <?php


                            ?>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <a class="btn btn-app " id="save">
        <i class="fa fa-save"></i> Save All
    </a>

</div>
@endsection()

@section('foot')


<script type="text/javascript">
    $(function () {
        // iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        });
    });
</script>
@endsection