<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pindelta.com | Admin System</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="{{ URL::asset('adminlte/bootstrap/css/bootstrap.min.css') }}" >
    <link rel="stylesheet" href="{{ URL::asset('adminlte/adminlte/css/_all-skins.min.css')}} ">
    <link rel="stylesheet" href="{{ URL::asset('adminlte/adminlte/css/AdminLTE.min.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('adminlte/plugins/icheck/all.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('adminlte/plugins/font-awesome/css/font-awesome.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('adminlte/plugins/datatables/dataTables.bootstrap.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('adminlte/plugins/icheck/minimal/minimal.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('js/jquery-file-upload/css/jquery.fileupload.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('adminlte/plugins/select2/select2.min.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('js/sweet-alert2/css/sweet-alert2.min.css')}}">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>