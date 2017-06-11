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
    <style>
        dd.tags{
            margin-bottom: 10px;
        }
    </style>
    <script src="{{ URL::asset('js/ckeditor/ckeditor.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('js/ckeditor/adapters/jquery.js')}}" type="text/javascript"></script>

    <div class="content-wrapper" style="height: auto;">
    <section class="content-header">
        <div class="box-body"><h2>產品管理</h2></div>
        <h1>
            <small><p class="text-light-blue"></p></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url()->route('admin::index')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">產品管理</li>
        </ol>
    </section>

    <section class="content">
        <div class="box">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-10">
                        <div class="box-body box-solid">
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab_1" data-toggle="tab">產品資料</a></li>
                                    <li><a href="#tab_2" data-toggle="tab">產品標籤</a></li>
                                    <!--隱藏點選標籤 <li><a href="#tab_3" data-toggle="tab">產品SEO描述</a></li> -->
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1">
                                        <!--tab1-->
                                        <div class="box-header with-border">
                                            <i class="fa fa-file-text-o"></i>
                                            <h3 class="box-title"> <?php echo ($data['act'] == 'add') ? '新增產品' : '編輯產品 ： <span style="color:#3c8dbc;font-weight:bold">'.$data['product']['name'] ?></span> </h3>
                                        </div>
                                        <div class="box-body">
                                            <dl class="dl-horizontal">
                                                <dt>編號:</dt>
                                                <dd># {{$data['product']['id']}}</dd>
                                                <br>
                                                <dt>名稱:</dt>
                                                <dd>
                                                    <input type="text" class="form-control" name="name" placeholder="產品名稱" value="{{$data['product']['name']}}">
                                                </dd>
                                                <br>
                                                <dt>所屬項目:</dt>
                                                <dd style="<?php echo ($data['act'] == 'edit') ? 'display:none;' : null; ?>">
                                                    <select class="form-control select2" id="category_id">
                                                        <option value="0" selected="selected">請選擇所屬項目</option>
                                                        <?php
                                                        if($data['act'] == 'add') {
                                                            foreach ($data['category'] as $k0 => $v0) {
                                                                echo '<option value="'.$v0['id'].'">'.$v0['name'].'</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </dd>
                                                <dd style="<?php echo ($data['act'] == 'add') ? 'display:none;' : null; ?>">
                                                    <p style="color:#00b7b0;font-weight: bold;font-size:14px;"><?php echo $data['product']['category_name'] ?></p>
                                                </dd>
                                                <br>
                                                <dt>排序:</dt>
                                                <dd>
                                                    <input type="number" class="form-control" name="priority" placeholder="1~255" min="0" max="255" value="<?php echo $data['product']['priority'] ?>">
                                                </dd>
                                                <br>
                                                <dt>型號:</dt>
                                                <dd>
                                                    <input type="text" class="form-control" name="model" placeholder="產品型號" value="{{$data['product']['model']}}">
                                                </dd>
                                                <br>
                                                <dt>規格:</dt>
                                                <dd>
                                                    <input type="text" class="form-control" name="standard" placeholder="產品規格" value="{{$data['product']['standard']}}">
                                                </dd>
                                                <br>
                                                <dt>材質:</dt>
                                                <dd>
                                                    <input type="text" class="form-control" name="material" placeholder="產品材質" value="{{$data['product']['material']}}">
                                                </dd>
                                                <br>
                                                <dt>生產所需時間:</dt>
                                                <dd>
                                                    <input type="text" class="form-control" name="produce_time" placeholder="產品生產時間" value="{{$data['product']['produce_time']}}">
                                                </dd>
                                                <br>
                                                <dt>最低訂購量:</dt>
                                                <dd>
                                                    <input type="text" class="form-control" name="lowest" placeholder="最低訂購量" value="{{$data['product']['lowest']}}">
                                                </dd>
                                                <br>
                                                <dt>狀態:</dt>
                                                <dd>
                                                    <div class="form-group">
                                                        <label for="r1">
                                                            <input id="r1" type="radio" name="status" class="minimal-red" value="open" <?php if($data['product']['status'] == 'open' || $data['product']['status'] == '') echo 'checked'; ?>>
                                                            Open
                                                        </label>&nbsp;&nbsp;&nbsp;
                                                        <label for="r2">
                                                            <input id="r2" type="radio" name="status" class="minimal-red" value="close" <?php if($data['product']['status'] == 'close') echo 'checked'; ?>>
                                                            Close
                                                        </label>
                                                    </div>
                                                </dd>
                                                <br>
                                                <dt>介紹:</dt>
                                                <dd>
                                                    <input type="text" class="form-control" name="description" placeholder="介紹" value="{{$data['product']['description']}}">
                                                </dd>
                                                <br>
                                                <dt>備註:</dt>
                                                <dd>
                                                    <textarea class="form-control" name="memo" rows="3" placeholder="Enter ...">{{$data['product']['memo']}}</textarea>
                                                </dd>
                                                <br>
                                                <dt>內文:</dt>
                                                <dd>
                                                    <textarea rows="10" cols="30" name="product_content" class="ckeditor" id="product_content">{{$data['product']['content']}}</textarea>
                                                    <script type="text/javascript">CKEDITOR.replace('product_content',
                                                            {
                                                                toolbar : 'Full',
                                                                width: '100%',
                                                                height: '300px'
                                                            });
                                                    </script>
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
                                                        <br><br>
                                                        <!-- The global progress bar -->
                                                        <div id="progress" class="progress">
                                                            <div class="progress-bar progress-bar-success"></div>
                                                        </div>
                                                        <!-- The container for the uploaded files -->
                                                        <div id="files" class="files"></div>
                                                        <br>
                                                        <img style="width:240px;height: 320px;" id="cover" alt="{{$data['product']['coverName']}}" src="{{$data['product']['coverUrl']}}"    onerror="this.src='{{asset('images/origin.png')}}'" data-state="old" class="img-responsive">
                                                    </div>
                                                </dd>
                                                <br>
                                                <dt>新增時間:</dt>
                                                <dd>
                                                    <p class="text-muted">{{ $data['product']['created_at'] or null  }}</p>
                                                </dd>
                                                <br>
                                                <dt>修改時間:</dt>
                                                <dd>
                                                    <p class="text-muted">{{ $data['product']['updated_at'] or null }}</p>
                                                </dd>
                                                <br>
                                                <dt>修改人員:</dt>
                                                <dd>
                                                    <p class="text-light-blue">{{$data['product']['admin_name']}}</p>
                                                </dd>
                                                <br>
                                            </dl>
                                        </div>
                                        <!--end tab1-->
                                    </div>
                                    <div class="tab-pane" id="tab_2">
                                        <!-- tab2-->
                                        <div class="box-header with-border">
                                            <i class="fa fa-file-text-o"></i><h3 class="box-title">產品標籤</h3>
                                        </div>
                                        <div class="box-body">
                                            <dl class="dl-horizontal tag_list">
                                                <dd>
                                                    <div>
                                                        <input id="add_tags" type="button" class="btn btn-primary" value="新增欄位"></input>
                                                    </div>
                                                </dd><br>
                                                <?php
                                                if(count($data['product']['tags']) > 0 ) {
                                                    foreach ($data['product']['tags'] as $k0 => $v0) {
                                                        echo '<dd class="tags">
                                                                <div>
                                                                    <input class="form-control" type="text" name="tags_name" style="width:20%;float: left" value="'.$v0.'">
                                                                    <input class="btn btn-danger delete_tags" type="button" value="刪除"></input>
                                                                </div>
                                                            </dd>';
                                                    }
                                                }
                                                ?>
                                            </dl>
                                        </div>
                                        <!-- end tab2-->
                                    </div>
                                    <div class="tab-pane" id="tab_3">
                                        <!-- tab3-->
                                        <div class="box-header with-border">
                                            <i class="fa fa-file-text-o"></i><h3 class="box-title">產品SEO描述 </h3>
                                        </div>
                                        <div class="box-body">
                                            <dl class="dl-horizontal tag_list">
                                                <dd>
                                                    <input type="text" class="form-control" name="product_meta" placeholder="產品SEO描述" value="">
                                                </dd><br>
                                            </dl>
                                        </div>
                                        <!-- end tab3-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a class="btn btn-app" href="{{url()->route('admin::product')}}">
            <i class="fa fa-angle-double-left"></i> 上一頁
        </a>
        <a class="btn btn-app" id="save">
            <i class="fa fa-save"></i> 儲存(Save)
        </a>
        <?php
        if($data['act'] =='edit') echo '<a class="btn btn-app" id="delete"><i class="fa fa-trash-o"></i> 刪除(Delete)</a>';
        ?>
    </section>
    <!-- For Clone -->
    <div style="display:none">
        <dd class="tags">
            <div>
                <input class="form-control" type="text" name="tags_name" style="width:20%;float: left">
                <input class="btn btn-danger delete_tags" type="button" value="刪除"></input>
            </div>
        </dd>
    </div>
</div>
@endsection()

@section('foot')
<script src="{{ URL::asset('js/ckeditor/ckeditor.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('js/ckeditor/adapters/jquery.js')}}" type="text/javascript"></script>

<script type="text/javascript">
    $(function () {
        'use strict';
        $("#category_id").select2();
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

        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
            checkboxClass: 'icheckbox_minimal-red',
            radioClass: 'iradio_minimal-red'
        });

        $('#add_tags').on('click', function() {
            $('dd.tags:last').clone().appendTo('dl.tag_list');
        });

        $('#save').on('click', function() {
            var priority = $('input[name=priority]').val(), tags = [],
                [id, act, name, category_id,priority, model, standard, material, produce_time, lowest, memo, content, status, description, cover, cover_state, meta] = [
                    '{{ $data['product']['id'] }}',
                    '{{ $data['act'] }}',
                    $('input[name="name"]').val(),
                    $('#category_id').val(),
                    priority,
                    $('input[name="model"]').val(),
                    $('input[name="standard"]').val(),
                    $('input[name="material"]').val(),
                    $('input[name="produce_time"]').val(),
                    $('input[name="lowest"]').val(),
                    $('textarea[name="memo"]').val(),
                    CKEDITOR.instances['product_content'].getData(),
                    $('input[name="status"]:checked').val(),
                    $('input[name="description"]').val(),
                    $('#cover').attr('alt'),
                    $('#cover').data('state'),
                    $('input[name="product_meta"]').val(),
                ];

            if (!/^\d+$/.test(priority)) {
                _swal({'status': 0, 'message': '排序須輸入正整數'});
            } else if(act == '' || name == '' || priority == '' || model =='' || standard =='' || material == '' || produce_time == '' || lowest == '' || content == '' || status == '' || description == '' || cover == '') {
                _swal({'status': 0, 'message': '資料未填寫完成, 請重新操作'});
            } else {
                $('input[name="tags_name"]').each(function(k ,v){
                    if($(this).val() != "") tags.push($(this).val());
                });
                $.ajax({
                    url : '{{url("admin/product/edit")}}',
                    type: 'post',
                    data: {
                        id : id,
                        act : act,
                        name : name,
                        category_id : category_id,
                        priority : priority,
                        model : model,
                        standard : standard,
                        material : material,
                        produce_time : produce_time,
                        lowest : lowest,
                        memo : memo,
                        content : content,
                        status : status,
                        description : description,
                        cover : cover,
                        cover_state : cover_state,
                        tags : tags,
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
        })

        $('#delete').on('click', function(){
            swal({
                title: '確定刪除: {{$data['product']['name'] or null}}',
                text: "此動作將無法還原",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '確定刪除',
                cancelButtonText: '取消',
            }).then(function () {
                $.ajax({
                    url : '{{url("admin/product/delete")}}',
                    type: 'post',
                    data: {
                        id : {{ $data['product']['id'] or 'null' }},
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

    $(document).on('click', '.delete_tags', function(){
        $(this).parents('dd.tags').remove();
    })
</script>
@endsection