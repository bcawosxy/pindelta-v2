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
    <script src="{{ URL::asset('js/ckeditor/ckeditor.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('js/ckfinder/ckfinder.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('js/ckeditor/adapters/jquery.js')}}" type="text/javascript"></script>

    <div class="content-wrapper" style="height: auto;">
    <section class="content-header">
        <div class="box-body"><h2>關於品利興</h2></div>
        <h1>
            <small><p class="text-light-blue">(建議上傳圖片格式: PNG / JPEG / JPG)</p></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href=" {{ url()->route('admin::index')  }} "><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">關於品利興</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-body">
                <form method="POST">
                    <textarea  id="about_value" name="about_value" class="ckeditor">{{$data['value']}}</textarea>
                    <script type="text/javascript">
                        var content = CKEDITOR.replace('about_value',
                            {
                                toolbar : 'Full',
                                width: '80%',
                                height: '400px',
                            });
                        CKFinder.setupCKEditor(content);
                    </script><br>
                    <a class="btn btn-app " id="save">
                        <i class="fa fa-save"></i> Save
                    </a>
                    <input type="submit" id="s_save" style="display: none;">
                </form>
            </div>
            <div class="box-footer">
                最後修改時間<p class="text-light-blue">{{$data['updated_at']}}</p>修改人員<p class="text-light-blue">{{$data['modify_name']}}</p>
            </div>
        </div>
    </section>
</div>
@endsection()

@section('foot')
<script type="text/javascript">
    $(function () {
        $('#save').on('click', function(){
            $.ajax({
                url: '{{url('admin/about')}}',
                type: 'post',
                data: {
                    value : CKEDITOR.instances['about_value'].getData(),
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                success: function (r) {
                    _swal(r);
                },
                error : function (r) {
                    r = r.responseJSON;
                    _swal(r);
                },
            });
        });
    })
</script>
@endsection