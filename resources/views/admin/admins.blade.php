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
        <div class="box-body"><h2>管理員設定</h2></div>
        <h1>
            <small><p class="text-light-blue">(若不需修改密碼請將該欄位留空)</p></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url()->route('admin::index')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">管理員設定</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">管理人員清單</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>#</th>
                                <th>登入帳號</th>
                                <th>密碼</th>
                                <th>名稱</th>
                                <th>Email</th>
                                <th>上次登入時間</th>
                                <th>上次登入IP</th>
                            </tr>
                            @foreach($data as $k0 => $v0)
                                <tr class="data">
                                    <td name="id">{{$v0['id']}}</td>
                                    <td><input type="text" name="account" class="form-control" value="{{$v0['account']}}"></td>
                                    <td><input type="password"  name="password" class="form-control" value=""></td>
                                    <td><input type="text"  name="name" class="form-control" value="{{$v0['name']}}"></td>
                                    <td><input type="text"  name="email" class="form-control" value="{{$v0['email']}}"></td>
                                    <td>{{$v0['updated_at']}}</td>
                                    <td>{{$v0['ip']}}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>

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
        $('#save').on('click', function() {
            var data = new Array();
            $('tr.data').each(function (k, v){
                var tmp = {
                    'id' : $(v).find('td[name="id"]').html(),
                    'password' : $(v).find('input[name="password"]').val(),
                    'account' : $(v).find('input[name="account"]').val(),
                    'name' : $(v).find('input[name="name"]').val(),
                    'email' : $(v).find('input[name="email"]').val(),
                };
                data.push(tmp);
            });

            $.ajax({
                url : '{{url("admin/admins/edit")}}',
                type: 'post',
                data: {
                    data : JSON.stringify(data),
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