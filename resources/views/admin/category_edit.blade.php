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
        <div class="box-body"><h2>產品項目管理</h2></div>
        <h1>
            <small><p class="text-light-blue"></p></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">產品項目管理</li>
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
                                <h3 class="box-title"> <?php //echo ($act == 'add') ? '新增產品項目' : '編輯產品項目 ： '.$data['category_name'] ?> </h3>
                            </div>
                            <div class="box-body">
                                <dl class="dl-horizontal">
                                    <dt>編號:</dt>
                                    <dd># <?php //echo $data['category_id'] ?></dd>
                                    <br>
                                    <dt>名稱:</dt>
                                    <dd>
                                        <input type="text" class="form-control" name="name" placeholder="產品類別名稱" style="width:30%" value="<?php //echo $data['category_name'] ?>">
                                    </dd>
                                    <br>
                                    <dt>所屬類別:</dt>
                                    <dd style="<?php //echo ($act == 'edit') ? 'display:none;' : null; ?>">
                                        <select class="form-control select2" id="categoryarea" style="width: 30%;">
                                            <option value="0" selected="selected">請選擇所屬類別</option>
                                            <?php
//                                            foreach ($categoryarea as $k0 => $v0) {
//                                                echo '<option value="'.$v0['categoryarea_id'].'">'.$v0['categoryarea_name'].'</option>';
//                                            }
                                            ?>
                                        </select>
                                    </dd>
                                    <dd style="<?php //echo ($act == 'add') ? 'display:none;' : null; ?>">
                                        <p style="color:#00b7b0;font-weight: bold;font-size:14px;"><?php //echo $data['categoryarea_name'] ?></p>
                                    </dd>
                                    <br>
                                    <dt>排序:</dt>
                                    <dd>
                                        <input type="number" class="form-control" name="priority" placeholder="1~255" min="0" max="255" style="width:20%" value="<?php //echo $data['category_priority'] ?>">
                                    </dd>
                                    <br>
                                    <dt>狀態:</dt>
                                    <dd>
                                        <div class="form-group">
                                            <label for="r1">
                                                <input id="r1" type="radio" name="status" class="minimal-red" value="open" <?php //if($data['category_status'] == 'open') echo 'checked'; ?>>
                                                Open
                                            </label>&nbsp;&nbsp;&nbsp;
                                            <label for="r2">
                                                <input id="r2" type="radio" name="status" class="minimal-red" value="close" <?php //if($data['category_status'] == 'close') echo 'checked'; ?>>
                                                Close
                                            </label>
                                        </div>
                                    </dd>
                                    <br>
                                    <dt>介紹:</dt>
                                    <dd>
                                        <input type="text" class="form-control" name="description" placeholder="介紹" style="width:80%" value="<?php// echo $data['category_description'] ?>">
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
                                            <img style="width:240px;height: 320px;" id="cover" alt="<?php //echo $cover ?>" src="<?php// echo $cover_dir ?>" onerror="this.src='<?php //echo URL_IMG_ROOT.'default_bg.png' ?>'" data-state="old" class="img-responsive">
                                        </div>
                                    </dd>
                                    <br>
                                    <dt>新增時間:</dt>
                                    <dd>
                                        <p class="text-muted"><?php //echo $data['category_insertime'] ?></p>
                                    </dd>
                                    <br>
                                    <dt>修改時間:</dt>
                                    <dd>
                                        <p class="text-muted"><?php //echo $data['category_modify_time'] ?></p>
                                    </dd>
                                    <br>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a class="btn btn-app" href="#">
            <i class="fa fa-angle-double-left"></i> 上一頁
        </a>

        <a class="btn btn-app" id="save">
            <i class="fa fa-save"></i> 儲存(Save)
        </a>

        <?php
       // if($act =='edit') echo '<a class="btn btn-app" id="delete"><i class="fa fa-trash-o"></i> 刪除(Delete)</a>';
        ?>
    </section>

</div>
@endsection()

@section('foot')


<script type="text/javascript">
    $(function () {
        $(".select2").select2();
        // some content code here
    });
</script>
@endsection