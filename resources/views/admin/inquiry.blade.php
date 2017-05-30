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
        <div class="box-body" ><h2>產品詢價</h2></div>
        <h1>
            <small><p class="text-light-blue"></p></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php //echo URL_ADMIN2_ROOT ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">產品詢價</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-11">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="<?php //echo $tab1; ?>"><a href="#tab_1" data-toggle="tab"><i class="fa fa-inbox"></i>&nbsp;&nbsp;Inbox</a></li>
                                <li class="<?php //echo $tab2; ?>"><a href="#tab_2" data-toggle="tab"><i class="fa fa-folder-open-o"></i>&nbsp;&nbsp;Archive</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane <?php //echo $tab1; ?>" id="tab_1">
                                    <div class="box-header">
                                        <div class="callout callout-success">
                                            <h4 style="font-family:微軟正黑體;">產品詢價 - 資料列表</h4>
                                        </div>
                                    </div>
                                    <div class="box-body">
                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>編輯</th>
                                                <th>詢價產品</th>
                                                <th>姓名</th>
                                                <th>Email</th>
                                                <th>國家</th>
                                                <th>公司名稱</th>
                                                <th>網站連結</th>
                                                <th>狀態</th>
                                                <th>read</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php

                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="tab-pane <?php //echo $tab2; ?>" id="tab_2">
                                    <div class="box-header">
                                        <div class="callout callout-success" >
                                            <h4 style="font-family:微軟正黑體;">產品詢價 - 封存列表</h4>
                                        </div>
                                    </div>
                                    <div class="box-body">
                                        <table id="example2" class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>編輯</th>
                                                <th>詢價產品</th>
                                                <th>姓名</th>
                                                <th>Email</th>
                                                <th>國家</th>
                                                <th>公司名稱</th>
                                                <th>網站連結</th>
                                                <th>狀態</th>
                                                <th>read</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php

                                            ?>
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
    </section>

</div>
@endsection()

@section('foot')


<script type="text/javascript">
    $(function () {

    });
</script>
@endsection