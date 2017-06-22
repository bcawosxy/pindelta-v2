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
        <div class="box-body"><h2>產品詢價</h2></div>
        <h1>
            <small><p class="text-light-blue"></p></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url()->route('admin::index')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{url()->route('admin::contact')}}">產品詢價</a></li>
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
                                    <dd>#{{$data['inquiry']['id']}}</dd>
                                    <dt>詢價產品:</dt>
                                    <dd>{{$data['inquiry']['product_name']}}</dd>
                                    <dt>姓名:</dt>
                                    <dd>{{$data['inquiry']['last_name']}} - {{$data['inquiry']['first_name']}}</dd>
                                    <dt>公司:</dt>
                                    <dd>{{$data['inquiry']['company']}}</dd>
                                    <dt>Email:</dt>
                                    <dd>{{$data['inquiry']['email']}}</dd>
                                    <dt>地區:</dt>
                                    <dd>{{$data['inquiry']['country']}}</dd>
                                    <dt>數量:</dt>
                                    <dd>{{$data['inquiry']['quantity']}}</dd>
                                    <dt>網站:</dt>
                                    <dd>{{$data['inquiry']['weblink']}}</dd>
                                    <dt>Logo需求:</dt>
                                    <dd>{{$data['inquiry']['demand']}}</dd>
                                    <dt>備註:</dt>
                                    <dd>{{$data['inquiry']['memo']}}</dd>
                                    <dt>狀態:</dt>
                                    <dd>{!! $data['inquiry']['status_text'] !!}</dd>
                                    <dt>閱讀人員:</dt>
                                    <dd>{{$data['inquiry']['reader_name']}}</dd>
                                    <dt>閱讀時間:</dt>
                                    <dd>{{$data['inquiry']['read_time']}}</dd>
                                    <dt>聯繫時間:</dt>
                                    <dd>{{$data['inquiry']['created_at']}}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <a class="btn btn-app" href="{{url()->route('admin::inquiry')}}">
        <i class="fa fa-angle-double-left"></i> 上一頁
    </a>
	<?php
	if($data['inquiry']['status'] == 'open') {
		echo '<a class="btn btn-app " id="archive">
						<i class="fa fa-envelope"></i> 封存(Archive)
					</a>';
	}
	?>
    <a class="btn btn-app " id="delete">
        <i class="fa fa-trash-o"></i> 刪除(Delete)
    </a>
</div>
@endsection()

@section('foot')

<script type="text/javascript">
    $(function () {
        $('#archive').on('click', function(){
            $.ajax({
                url : '{{url("admin/inquiry/edit")}}',
                type: 'post',
                data: {
                    id : {{ $data['inquiry']['id'] or 'null' }},
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

        $('#delete').on('click', function(){
            swal({
                title: '確定刪除此筆詢價資料嗎?',
                text: "此動作將無法還原",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '確定刪除',
                cancelButtonText: '取消',
            }).then(function () {
                $.ajax({
                    url : '{{url("admin/inquiry/delete")}}',
                    type: 'post',
                    data: {
                        id : {{ $data['inquiry']['id'] or 'null' }},
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
    });
</script>
@endsection