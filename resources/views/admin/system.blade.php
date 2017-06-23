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
            <li><a href="{{url()->route('admin::index')}}"><i class="fa fa-dashboard"></i> Home</a></li>
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
                <input class="form-control" maxlength="30" name="web_title" style="max-width:500px;" type="text" placeholder="Text" value="{{$data['web_title']}}"><br>
                <label>Description</label> :
                <input class="form-control" maxlength="50" name="web_description" style="max-width:500px;" type="text" placeholder="Description" value="{{$data['web_description']}}">
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
                    <input type="text" class="form-control" name="office_info_phone" style="max-width:465px;" value="{{$data['office_info_phone']}}">
                </div>

                <label>Email</label> :
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-envelope"></i>
                    </div>
                    <input type="text" class="form-control" name="office_info_email" style="max-width:465px;" value="{{$data['office_info_email']}}">
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
                        <input type="radio" name="r1" value="horizontal" class="minimal" <?php echo $data['social']['look']['horizontal'] ?> >
                        展開
                    </label>&nbsp;&nbsp;&nbsp;
                    <label>
                        <input type="radio" name="r1" value="single" class="minimal" <?php echo $data['social']['look']['single'] ?>>
                        收合
                    </label>
                </div>
                <label>樣式</label> :
                <div class="form-group">
                    <label>
                        <input type="radio" name="r2" value="flat" class="minimal" <?php echo $data['social']['skin']['flat'] ?>>
                        A
                    </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <label>
                        <input type="radio" name="r2" value="birman" class="minimal" <?php echo $data['social']['skin']['birman'] ?>>
                        B
                    </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <label>
                        <input type="radio" name="r2" value="classic" class="minimal" <?php echo $data['social']['skin']['classic'] ?>>
                        C
                    </label>
                </div>
            </div>
        </div>
    </section>
    <section class="content" style="min-height:180px;">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">網站維護</h3>
                <h4>
                    <small><p class="text-light-blue">(網站維護模式)</p></small>
                </h4>
            </div>
            <div class="box-body">
                <label>網站狀態</label> :
                <div class="form-group">
                    <label>
                        <input type="radio" name="r3" value="open" class="minimal" <?php echo ($data['maintain']) ? 'checked="true"' : null; ?> >
                        開啟
                    </label>&nbsp;&nbsp;&nbsp;
                    <label>
                        <input type="radio" name="r3" value="close" class="minimal" <?php echo (!$data['maintain']) ? 'checked="true"' : null; ?>>
                        關閉
                    </label>
                </div>
            </div>
        </div>
    </section>
    <section class="content" style="min-height:180px;">
        <div class="box">
            <div class="box-footer">
                最後修改時間<p class="text-light-blue">{{$data['updated_at']}}</p>
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

        $('#save').on('click', function() {
            $.ajax({
                url : '{{url("admin/system/edit")}}',
                type: 'post',
                data: {
                    web_title : $(':input[name="web_title"]').val(),
                    web_description : $(':input[name="web_description"]').val(),
                    office_info_phone : $(':input[name="office_info_phone"]').val(),
                    office_info_email : $(':input[name="office_info_email"]').val(),
                    r1 : $('input[name=r1]:checked').val(),
                    r2 : $('input[name=r2]:checked').val(),
                    r3 : $('input[name=r3]:checked').val(),
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

        })
    });
</script>
@endsection