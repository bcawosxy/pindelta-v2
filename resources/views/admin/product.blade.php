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
            <li><a href="{{url()->route('admin::product')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">產品管理</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box-header">
                        </div>
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>編輯</th>
                                    <th>名稱</th>
                                    <th>產品項目id</th>
                                    <th>產品項目名稱</th>
                                    <th>優先順序</th>
                                    <th>產品描述</th>
                                    <th>狀態</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($data as $v0)
                                    <tr>
                                        <td>{{$v0['id']}}</td>
                                        <td><a href="{{url()->route('admin::product_content', ['id' => $v0['id'] ])}}">編輯</a></td>
                                        <td>{{$v0['name']}}</td>
                                        <td>{{$v0['category_id']}}</td>
                                        <td style="color:#00b7b0;">{{$v0['category_name']}}</td>
                                        <td>{{$v0['priority']}}</td>
                                        <td>{{$v0['description']}}</td>
                                        <td>{!! $v0['status'] == 'open' ? '<span class="label label-success">Open</span>' : '<span class="label label-warning">Close</span>' !!}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <a class="btn btn-app " id="add" href="{{url('admin/product/edit')}}">
                            <i class="fa fa-plus-square-o"></i> Add
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection()

@section('foot')


<script type="text/javascript">
    $(function () {
        $("#example1").DataTable({
            "order": [[ 0, "desc" ]],
            "pageLength": 25,
        });
    });
</script>
@endsection