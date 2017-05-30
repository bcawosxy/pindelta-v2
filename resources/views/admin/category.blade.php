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
                                    <th>所屬類別id</th>
                                    <th>所屬類別名稱</th>
                                    <th>優先順序</th>
                                    <th>描述</th>
                                    <th>狀態</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                        <a class="btn btn-app " id="add" href="{{url('admin/category/edit')}}">
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

        });
    });
</script>
@endsection