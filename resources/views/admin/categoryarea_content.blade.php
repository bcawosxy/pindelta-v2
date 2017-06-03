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
        <div class="box-body"><h2>產品類別管理</h2></div>
        <h1>
            <small><p class="text-light-blue"></p></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url()->route('admin::index')  }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">產品類別管理</li>
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
                                <h3 class="box-title">
                                    @if ($data['act'] == 'add')
                                        '新增產品類別'
                                    @else
                                        編輯產品類別：{{$data['categoryarea']['name']}}
                                    @endif
                                </h3>
                            </div>
                            <div class="box-body">
                                <dl class="dl-horizontal">
                                    <dt>編號:</dt>
                                    <dd>#{{  $data['categoryarea']['id'] or '1' }}</dd>
                                    <br>
                                    <dt>名稱:</dt>
                                    <dd>
                                        <input type="text" class="form-control" name="name" placeholder="產品類別名稱" style="width:30%" value="{{  $data['categoryarea']['name'] or null }}">
                                    </dd>
                                    <br>
                                    <dt>排序:</dt>
                                    <dd>
                                        <input type="number" class="form-control" name="priority" placeholder="1~255" min="0" max="255" style="width:20%" value="<?php echo $data['categoryarea']['priority']; ?>">
                                    </dd>
                                    <br>
                                    <dt>狀態:</dt>
                                    <dd>
                                        <div class="form-group">
                                            <label for="r1">
                                                <input id="r1" type="radio" name="status" class="minimal-red" value="open" <?php if($data['categoryarea']['status'] == 'open') echo 'checked'; ?>>
                                                Open
                                            </label>&nbsp;&nbsp;&nbsp;
                                            <label for="r2">
                                                <input id="r2" type="radio" name="status" class="minimal-red" value="close" <?php if($data['categoryarea']['status'] == 'close') echo 'checked'; ?>>
                                                Close
                                            </label>
                                        </div>
                                    </dd>
                                    <br>
                                    <dt>介紹:</dt>
                                    <dd>
                                        <input type="text" class="form-control" name="description" placeholder="介紹" style="width:80%" value="{{$data['categoryarea']['description'] or null }}">
                                    </dd>
                                    <br>
                                    <dt>封面:</dt>
                                    <dd>
                                        <div class="form-group">
                                            <!-- The fileinput-button span is used to style the file input field as button -->
                                            <span class="btn btn-success fileinput-button">
												        <i class="glyphicon glyphicon-plus"></i>
												        <span>Select files...</span>
                                                <!-- The file input field used as target for the file upload widget -->
												        <input id="fileupload" type="file" name="files[]" multiple>
												    </span>
                                            <br>
                                            <br>
                                            <!-- The global progress bar -->
                                            <div id="progress" class="progress">
                                                <div class="progress-bar progress-bar-success"></div>
                                            </div>
                                            <!-- The container for the uploaded files -->
                                            <div id="files" class="files"></div>
                                            <br>
                                            <img style="width:240px;height: 320px;" id="cover" alt="<?php// echo $cover ?>" src="#" onerror="this.src='<?php //echo URL_IMG_ROOT.'default_bg.png' ?>'" data-state="old" class="img-responsive">
                                        </div>
                                    </dd>
                                    <br>
                                    <dt>新增時間:</dt>
                                    <dd>
                                        <p class="text-muted">{{ $data['categoryarea']['created_at'] or null  }}</p>
                                    </dd>
                                    <br>
                                    <dt>修改時間:</dt>
                                    <dd>
                                        <p class="text-muted">{{ $data['categoryarea']['updated_at'] or null }}</p>
                                    </dd>
                                    <br>
                                    <dt>修改人員:</dt>
                                    <dd>
                                        <p class="text-light-blue">{{$data['categoryarea']['admin_name']}}</p>
                                    </dd>
                                    <br>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a class="btn btn-app" href="{{ url()->route('admin::categoryarea')  }}">
            <i class="fa fa-angle-double-left"></i> 上一頁
        </a>

        <a class="btn btn-app" id="save">
            <i class="fa fa-save"></i> 儲存(Save)
        </a>

        @if ($data['act'] == 'edit')
            <a class="btn btn-app" id="delete"><i class="fa fa-trash-o"></i> 刪除(Delete)</a>
        @endif
    </section>


</div>
@endsection()

@section('foot')

<script type="text/javascript">
    $(function () {
        'use strict';
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
            checkboxClass: 'icheckbox_minimal-red',
            radioClass: 'iradio_minimal-red'
        });

        $('#save').on('click', function(){
            var priority = $('input[name=priority]');

            if (!/^\d+$/.test(priority.val())) {
                var r = {'status': 0, 'message': '排序須輸入正整數。'};
                _swal(r);
            } else {
                $.ajax({
                    url : '{{  url("admin/categoryarea/edit") }}',
                    type: 'post',
                    data: {
                        id : "{{ $data['categoryarea']['id'] }}",
                        act : "{{ $data['act'] }}",
                        name : $('input[name="name"]').val(),
                        priority : priority.val(),
                        status : $('input[name="status"]:checked').val(),
                        description : $('input[name="description"]').val(),
//                        cover : $('#cover').attr('alt'),
//                        cover_state : $('#cover').data('state'),
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json',
                    success: function (r) {
                        _swal(r);
                    },
                    error: function (r) {
                        r = r.responseJSON;
                        _swal(r);
                    },
                });
            }
        });
    });
</script>
@endsection