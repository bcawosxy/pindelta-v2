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
    <script src="{{ URL::asset('js/ckeditor/adapters/jquery.js')}}" type="text/javascript"></script>

    <div class="content-wrapper" style="height: auto;">
    <section class="content-header">
        <div class="box-body"><h2>關於品利興</h2></div>
        <h1>
            <small><p class="text-light-blue">(建議上傳圖片格式: PNG / JPEG / JPG)</p></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">關於品利興</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-body">
                <form method="post">
                    <textarea  id="about_value" name="about_value" class="ckeditor">{{$data['value']}}</textarea>
                    <script type="text/javascript">
                        CKEDITOR.replace('about_value',
                            {
                                toolbar : 'Full',
                                width: '80%',
                                height: '400px'
                            });
                    </script><br>
                    <a class="btn btn-app " id="save">
                        <i class="fa fa-save"></i> Save
                    </a>
                </form>

            </div>
            <div class="box-footer">
                最後修改時間<p class="text-light-blue">{{$data['updated_at']}}</p>修改人員<p class="text-light-blue">Vera-Fu</p>
            </div>
        </div>
    </section>
</div>
@endsection()

@section('foot')

<script type="text/javascript">

</script>
@endsection