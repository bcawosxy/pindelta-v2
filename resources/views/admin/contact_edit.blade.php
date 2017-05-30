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
        <div class="box-body"><h2>聯繫我們</h2></div>
        <h1>
            <small><p class="text-light-blue"></p></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php //echo URL_ADMIN2_ROOT ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php //echo URL_ADMIN2_ROOT.'contact/' ?>">聯繫我們</a></li>
            <li class="active">詳情</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-10">
                        <div class="box-body box-solid">
                            <div class="box-header with-border">
                                <i class="fa fa-file-text-o"></i>
                                <h3 class="box-title"> 詳情 </h3>
                            </div>
                            <div class="box-body">
                                <dl class="dl-horizontal">
                                    <dt>編號:</dt>
                                    <dd><?php //echo '#'.$data['id'] ?></dd>
                                    <dt>姓名:</dt>
                                    <dd><?php //echo $data['last_name'].' - '.$data['first_name'] ?></dd>
                                    <dt>公司:</dt>
                                    <dd><?php //echo $data['company'] ?></dd>
                                    <dt>電話:</dt>
                                    <dd><?php //echo $data['tel'] ?></dd>
                                    <dt>傳真:</dt>
                                    <dd><?php //echo $data['tel'] ?></dd>
                                    <dt>地址:</dt>
                                    <dd><?php //echo $data['address'] ?></dd>
                                    <dt>Email:</dt>
                                    <dd><?php //echo $data['email'] ?></dd>
                                    <dt>備註:</dt>
                                    <dd><?php //echo $data['memo'] ?></dd>
                                    <dt>狀態:</dt>
                                    <dd><?php //echo $status_text ?></dd>
                                    <dt>閱讀人員:</dt>
                                    <dd><?php //echo $data['reader'] ?></dd>
                                    <dt>閱讀時間:</dt>
                                    <dd><?php //echo $data['read_time'] ?></dd>
                                    <dt>聯繫時間:</dt>
                                    <dd><?php //echo $data['inserttime'] ?></dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <a class="btn btn-app" href="<?php //echo URL_ADMIN2_ROOT.'contact/index.php?tab='.$tab ?>">
        <i class="fa fa-angle-double-left"></i> 上一頁
    </a>
    <?php
//    if($data['status'] == 'open') {
//        echo '<a class="btn btn-app " id="archive">
//						<i class="fa fa-envelope"></i> 封存(Archive)
//					</a>';
//    }
    ?>
    <a class="btn btn-app " id="delete">
        <i class="fa fa-trash-o"></i> 刪除(Delete)
    </a>
</div>
@endsection()

@section('foot')


<script type="text/javascript">
    $(function () {

    });
</script>
@endsection