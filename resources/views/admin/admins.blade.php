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
        <div class="box-body"><h2>管理員設定</h2></div>
        <h1>
            <small><p class="text-light-blue">(若不需修改密碼請將該欄位留空)</p></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php //echo URL_ADMIN2_ROOT.'system/admin.php' ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">管理員設定</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">管理人員清單</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th style="width: 15%">帳號</th>
                                <th style="width: 15%">密碼</th>
                                <th style="width: 15%">名稱</th>
                                <th style="width: 15%">Email</th>
                                <th>上次登入時間</th>
                                <th>上次登入IP</th>
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

    });
</script>
@endsection