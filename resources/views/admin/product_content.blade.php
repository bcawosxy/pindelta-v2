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
                                                    <input type="text" class="form-control" name="name" placeholder="產品名稱" style="width:30%" value="{{$data['product']['name']}}">
                                                </dd>
                                                <br>
                                                <dt>所屬項目:</dt>
                                                <dd style="<?php echo ($data['act'] == 'edit') ? 'display:none;' : null; ?>">
                                                    <select class="form-control select2" id="category_id" style="width: 30%;">
                                                        <option value="0" selected="selected">請選擇所屬項目</option>
                                                        <?php
//                                                        foreach ($a_category as $k0 => $v0) {
//                                                            echo '<option value="'.$v0['category_id'].'">'.$v0['category_name'].'</option>';
//                                                        }
                                                        ?>
                                                    </select>
                                                </dd>
                                                <dd style="<?php echo ($data['act'] == 'add') ? 'display:none;' : null; ?>">
                                                    <p style="color:#00b7b0;font-weight: bold;font-size:14px;"><?php echo $data['product']['category_name'] ?></p>
                                                </dd>
                                                <br>
                                                <dt>排序:</dt>
                                                <dd>
                                                    <input type="number" class="form-control" name="priority" placeholder="1~255" min="0" max="255" style="width:20%" value="<?php echo $data['product']['priority'] ?>">
                                                </dd>
                                                <br>
                                                <dt>型號:</dt>
                                                <dd>
                                                    <input type="text" class="form-control" name="model" placeholder="產品型號" style="width:30%" value="{{$data['product']['model']}}">
                                                </dd>
                                                <br>
                                                <dt>規格:</dt>
                                                <dd>
                                                    <input type="text" class="form-control" name="standard" placeholder="產品規格" style="width:30%" value="{{$data['product']['standard']}}">
                                                </dd>
                                                <br>
                                                <dt>材質:</dt>
                                                <dd>
                                                    <input type="text" class="form-control" name="material" placeholder="產品材質" style="width:30%" value="{{$data['product']['material']}}">
                                                </dd>
                                                <br>
                                                <dt>生產所需時間:</dt>
                                                <dd>
                                                    <input type="text" class="form-control" name="produce_time" placeholder="產品生產時間" style="width:30%" value="{{$data['product']['produce_time']}}">
                                                </dd>
                                                <br>
                                                <dt>最低訂購量:</dt>
                                                <dd>
                                                    <input type="text" class="form-control" name="lowest" placeholder="最低訂購量" style="width:30%" value="{{$data['product']['lowest']}}">
                                                </dd>
                                                <br>
                                                <dt>狀態:</dt>
                                                <dd>
                                                    <div class="form-group">
                                                        <label for="r1">
                                                            <input id="r1" type="radio" name="status" class="minimal-red" value="open" <?php if($data['product']['status'] == 'open' || $data['categoryarea']['status'] == '') echo 'checked'; ?>>
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
                                                    <input type="text" class="form-control" name="description" placeholder="介紹" style="width:80%" value="{{$data['product']['description']}}">
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
                                            <i class="fa fa-file-text-o"></i><h3 class="box-title">產品標籤 </h3>
                                        </div>
                                        <div class="box-body">
                                            <dl class="dl-horizontal tag_list">
                                                <dd>
                                                    <div>
                                                        <input id="add_tags" type="button" class="btn btn-primary" value="新增欄位"></input>
                                                    </div>
                                                </dd><br>
                                                <?php
//                                                if(count($tags) > 0 ) {
//                                                    foreach ($tags as $k0 => $v0) {
//                                                        echo '<dd class="tags">
//																		<div>
//																			<input class="form-control" type="text" name="tags_name" style="width:20%;float: left" value="'.$v0.'">
//																			<input class="btn btn-danger delete_tags" type="button" value="刪除"></input>
//																		</div>
//																	</dd>';
//                                                    }
//                                                }
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
                                                    <input type="text" class="form-control" name="product_meta" placeholder="產品SEO描述" style="width:60%" value="<?php //echo $meta ?>">
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
        <a class="btn btn-app" href="<?php //echo URL_ADMIN2_ROOT.'product' ?>">
            <i class="fa fa-angle-double-left"></i> 上一頁
        </a>

        <a class="btn btn-app" id="save">
            <i class="fa fa-save"></i> 儲存(Save)
        </a>

        <?php
        //if($act =='edit') echo '<a class="btn btn-app" id="delete"><i class="fa fa-trash-o"></i> 刪除(Delete)</a>';
        ?>
    </section>

</div>
@endsection()

@section('foot')
    <script src="{{ URL::asset('js/ckeditor/ckeditor.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('js/ckeditor/adapters/jquery.js')}}" type="text/javascript"></script>

<script type="text/javascript">
    $(function () {
        $("#category_id").select2();
        // some content code here
    });
</script>
@endsection