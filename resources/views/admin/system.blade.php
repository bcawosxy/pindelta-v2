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
        <div class="box-body"><h2>系統參數設定</h2></div>
        <ol class="breadcrumb">
            <li><a href="<?php //echo URL_ADMIN2_ROOT ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">系統參數設定</li>
        </ol>
    </section>
    <section class="content" style="min-height:180px;">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Title 及 Description</h3>
                <h4>
                    <small><p class="text-light-blue">(網站標題及描述)</p></small>
                </h4>
            </div>
            <div class="box-body">
                <label>Title</label> :
                <input class="form-control" maxlength="30" name="web_title" style="max-width:500px;" type="text" placeholder="Text" value="<?php //echo $row['web_title'] ?>"><br>
                <label>Description</label> :
                <input class="form-control" maxlength="50" name="web_description" style="max-width:500px;" type="text" placeholder="Description" value="<?php //echo $row['web_description'] ?>">
            </div>
            <div class="box-footer">
                <?php //edit_info([])?>
            </div>
        </div>
    </section>
    <section class="content" style="min-height:180px;">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">聯絡資料</h3>
                <h4>
                    <small><p class="text-light-blue">(Contact頁面中的聯絡資料)</p></small>
                </h4>
            </div>
            <div class="box-body">
                <label>Phone</label> :
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-phone"></i>
                    </div>
                    <input type="text" class="form-control" name="office_info_phone" style="max-width:465px;" value="<?php //echo $row['office_info_phone'] ?>">
                </div>

                <label>Email</label> :
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-envelope"></i>
                    </div>
                    <input type="text" class="form-control" name="office_info_email" style="max-width:465px;" value="<?php //echo $row['office_info_email'] ?>">
                </div>
            </div>
            <div class="box-footer">
                <?php //edit_info([])?>
            </div>
        </div>
    </section>
    <section class="content" style="min-height:180px;">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">社群網站連結樣式</h3>
                <h4>
                    <small><p class="text-light-blue">(產品頁面上方社群網站樣式)</p></small>
                </h4>
            </div>
            <div class="box-body">
                <label>型態</label> :
                <div class="form-group">
                    <label>
                        <input type="radio" name="r1" value="horizontal" class="minimal" <?php //echo $horizontal_check; ?>>
                        展開
                    </label>&nbsp;&nbsp;&nbsp;
                    <label>
                        <input type="radio" name="r1" value="single" class="minimal" <?php //echo $single_check; ?>>
                        收合
                    </label>
                </div>
                <label>樣式</label> :
                <div class="form-group">
                    <label>
                        <input type="radio" name="r2" value="flat" class="minimal" <?php //echo $flat_check; ?>>
                        A
                    </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <label>
                        <input type="radio" name="r2" value="birman" class="minimal" <?php //echo $birman_check; ?>>
                        B
                    </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <label>
                        <input type="radio" name="r2" value="classic" class="minimal" <?php //echo $classic_check; ?>>
                        C
                    </label>
                </div>
            </div>
        </div>
    </section>
    <section class="content" style="min-height:180px;">
        <div class="box">
            <div class="box-footer">
                <?php //edit_info(['最後修改時間'=>$row['modify_time'],'修改人員'=>$row['modify_name']]); ?>
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

        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        });
    });
</script>
@endsection