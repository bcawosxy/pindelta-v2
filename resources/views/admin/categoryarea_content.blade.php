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
            <li><a href="{{ url()->route('admin::index')}}"><i class="fa fa-dashboard"></i> Home</a></li>
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
                                    <?php echo ($data['act'] == 'add') ? '新增產品類別' : '編輯產品類別： '.$data['categoryarea']['name'] ; ?>
                                </h3>
                            </div>
                            <div class="box-body">
                                <dl class="dl-horizontal">
                                    <dt>編號:</dt>
                                    <dd>#{{  $data['categoryarea']['id'] or null }}</dd>
                                    <br>
                                    <dt>名稱:</dt>
                                    <dd>
                                        <input type="text" class="form-control" name="name" placeholder="產品類別名稱" value="{{  $data['categoryarea']['name'] or null }}">
                                    </dd>
                                    <br>
                                    <dt>排序:</dt>
                                    <dd>
                                        <input type="number" class="form-control" name="priority" placeholder="1~255" min="0" max="255" value="<?php echo $data['categoryarea']['priority']; ?>">
                                    </dd>
                                    <br>
                                    <dt>狀態:</dt>
                                    <dd>
                                        <div class="form-group">
                                            <label for="r1">
                                                <input id="r1" type="radio" name="status" class="minimal-red" value="open" <?php if($data['categoryarea']['status'] == 'open' || $data['categoryarea']['status'] == '') echo 'checked'; ?>>
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
                                        <input type="text" class="form-control" name="description" placeholder="介紹" value="{{$data['categoryarea']['description'] or null }}">
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
                                            <img style="width:240px;height: 320px;" id="cover" alt="{{$data['categoryarea']['coverName']}}" src="{{$data['categoryarea']['coverUrl']}}" onerror="this.src='{{asset('images/origin.png')}}'" data-state="old" class="img-responsive">
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
        <a class="btn btn-app" href="{{url()->route('admin::categoryarea')}}">
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

        $('#fileupload').fileupload({
            url: "{{ url()->route('admin::fileUpload')  }}",
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            done: function (e, data) {
                $.each(data.result.files, function (index, file) {
                    if( file.error ) {
                        _swal({'status': 0, 'message': file.error});
                        $('#progress .progress-bar').css('width', '0%');
                    } else {
                        var target = '<?php echo URL('upload/files'); ?>/';
                        $('#cover').attr({'alt': file.name, 'src': target + file.name}).data('state', 'new');
                    }
                });
            },
            progressall: function (e, data) {
                var progress = parseInt(data.loaded / data.total * 100, 10);
                $('#progress .progress-bar').css('width', progress + '%');
            }
        }).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');

        $('#save').on('click', function() {
            var [id, act, name, priority, status, description, cover, cover_state] = [
                    '{{ $data['categoryarea']['id'] }}',
                    '{{ $data['act'] }}',
                    $('input[name="name"]').val(),
                    $('input[name=priority]').val(),
                    $('input[name="status"]:checked').val(),
                    $('input[name="description"]').val(),
                    $('#cover').attr('alt'),
                    $('#cover').data('state')
                ];

            if (!/^\d+$/.test(priority)) {
                _swal({'status': 0, 'message': '排序須輸入正整數'});
            } else if(act == '' || name == '' || priority == '' || status == '' || description == '' || cover == '') {
                _swal({'status': 0, 'message': '資料未填寫完成, 請重新操作'});
            } else {
                $.ajax({
                    url : '{{  url("admin/categoryarea/edit") }}',
                    type: 'post',
                    data: {
                        id : id,
                        act : act,
                        name : name,
                        priority : priority,
                        status : status,
                        description : description,
                        cover : cover,
                        cover_state : cover_state,
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

        $('#delete').on('click', function(){
            swal({
                title: '確定刪除: {{$data['categoryarea']['name'] or null}}',
                text: "此動作將無法還原",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '確定刪除',
                cancelButtonText: '取消',
            }).then(function () {
                $.ajax({
                    url : '{{url("admin/categoryarea/delete")}}',
                    type: 'post',
                    data: {
                        id : {{ $data['categoryarea']['id'] or 'null' }},
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
            });
        });
    });
</script>
@endsection