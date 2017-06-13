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
        <div class="box-body">
            <h2 style="font-family: 'Source Sans Pro',sans-serif;font-size: 30px;margin-top: 20px; margin-bottom: 10px;font-weight: 500; line-height: 1.1;color: inherit;">
                社群網站連結
            </h2>
        </div>
        <h1>
            <small><p class="text-light-blue"></p></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">社群網站連結</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-10">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">社群網站連結清單</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>#</th>
                                <th>名稱</th>
                                <th>連結</th>
                                <th>排序(1~{{count($data)}})</th>
                                <th>顯示狀態</th>
                            </tr>
                            @foreach($data as $k0 => $v0)
                               <?php
                                    $status_on = ($v0['status'] == 'open') ? 'checked' : null;
                                    $status_off = ($v0['status'] == 'close') ? 'checked' : null;
                                ?>
                               <tr class="data">
                                   <td name="sociallink_id">{{$v0['id']}}</td>
                                   <td><small class="label label-success">{{ucfirst($v0['name'])}}</small></td>
                                   <td>
                                       <div class="input-group">
                                           <div class="input-group-addon bg-light-blue color-palette">
                                               <i class="fa {{$icon[$k0]}}"></i>
                                           </div>
                                           <input type="text" name="url" class="form-control" value="{{urldecode($v0['url'])}}">
                                       </div>
                                   </td>
                                   <td>
                                       <div class="input-group">
                                           <input type="number" name="priority" min="1" max="{{count($data) }}" class="form-control" value="{{($v0['priority'])}}">
                                       </div>
                                   </td>
                                   <td>
                                       <div class="form-group">
                                           <label>
                                               <input type="radio" name="status_{{$k0}}" value="open" class="minimal" {{$status_on}}> On
                                           </label>
                                           &nbsp;&nbsp;&nbsp;&nbsp;
                                           <label>
                                               <input type="radio" name="status_{{$k0}}" value="close" class="minimal" {{$status_off}}> Off
                                           </label>
                                       </div>
                                   </td>
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
        // iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        });

        $('#save').on('click', function() {
            var data = new Array();
            $('tr.data').each(function (k, v){
                var obj = $(v),
                    tmp = [
                        $(obj).find('td[name="sociallink_id"]').html(),
                        $(obj).find(':input[name="url"]').val(),
                        $(obj).find('[name="priority"]').val(),
                        $(obj).find('input[name="status_'+k+'"]:checked').val(),
                    ];
                data.push(tmp);
            });

            $.ajax({
                url : '{{url("admin/sociallink/edit")}}',
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