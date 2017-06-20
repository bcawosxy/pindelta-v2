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
            <div class="box-body"><h2>聯繫我們</h2></div>
            <h1>
                <small><p class="text-light-blue"></p></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url()->route('admin::index')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">聯繫我們</li>
            </ol>
        </section>
        <section class="content">
            <div class="box">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab_1" data-toggle="tab"><i class="fa fa-inbox"></i>&nbsp;&nbsp;Inbox</a>
                                    </li>
                                    <li><a href="#tab_2" data-toggle="tab"><i class="fa fa-folder-open-o"></i>&nbsp;&nbsp;Archive</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1">
                                        <div class="box-header">
                                        </div>
                                        <div class="box-body">
                                            <table id="example1" class="table table-bordered table-striped">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>編輯</th>
                                                    <th>Last Name</th>
                                                    <th>First Name</th>
                                                    <th>Email</th>
                                                    <th>Tel</th>
                                                    <th>Read</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach ($data['open'] as $v0)
                                                    <tr>
                                                        <td>{{$v0['id']}}</td>
                                                        <td><a href="{{url()->route('admin::contact_content', ['id' => $v0['id']])}}">編輯</a></td>
                                                        <td>{{$v0['last_name']}}</td>
                                                        <td>{{$v0['first_name']}}</td>
                                                        <td>{{$v0['email']}}</td>
                                                        <td>{{$v0['tel']}}</td>
                                                        <td>{!! $v0['read'] !!}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="tab-pane " id="tab_2">
                                        <div class="box-header">
                                        </div>
                                        <div class="box-body">
                                            <table id="example2" class="table table-bordered table-striped">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>編輯</th>
                                                    <th>Last Name</th>
                                                    <th>First Name</th>
                                                    <th>Email</th>
                                                    <th>Tel</th>
                                                    <th>Read</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach ($data['archive'] as $v0)
                                                    <tr>
                                                        <td>{{$v0['id']}}</td>
                                                        <td><a href="{{url()->route('admin::contact_content', ['id' => $v0['id']])}}">編輯</a></td>
                                                        <td>{{$v0['last_name']}}</td>
                                                        <td>{{$v0['first_name']}}</td>
                                                        <td>{{$v0['email']}}</td>
                                                        <td>{{$v0['tel']}}</td>
                                                        <td>{!! $v0['read'] !!}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                "order": [[0, "desc"]],
                "columnDefs": [
                    {"orderable": false, "targets": 6}
                ]

            });

            $("#example2").DataTable({
                "order": [[0, "desc"]],
                "columnDefs": [
                    {"orderable": false, "targets": 6}
                ]

            });
        });
    </script>
@endsection