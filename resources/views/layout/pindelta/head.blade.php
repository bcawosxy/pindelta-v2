<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<!-- Head BEGIN -->
<head>
    <meta charset="utf-8">
    <title>{{$pageInfo['title'] }}</title>

    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="{{$pageInfo['description'] }}" name="description">
    {{--<meta content="" name="keywords">--}}
    <meta content="keenthemes" name="author">

    <meta property="og:site_name" content="Pindelta.com">
    <meta property="og:title" content="{{$pageInfo['title'] }}">
    <meta property="og:description" content="{{$pageInfo['description'] }}">
    <meta property="og:type" content="website">
    {{--<meta property="og:image" content="-CUSTOMER VALUE-">--}}
    <meta property="og:url" content="http://www.pindelta.com">

    <link rel="shortcut icon" href="favicon.ico">

    <!-- Fonts START -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|PT+Sans+Narrow|Source+Sans+Pro:200,300,400,600,700,900&amp;subset=all" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900&amp;subset=all" rel="stylesheet" type="text/css"><!--- fonts for slider on the index page -->
    <!-- Fonts END -->

    <!-- Global styles START -->
    <link href="{{ URL::asset('template/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('template/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Global styles END -->

    <!-- Page level plugin styles START -->
    <link href="{{ URL::asset('template/pages/css/animate.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('template/plugins/fancybox/source/jquery.fancybox.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('template/plugins/owl.carousel/assets/owl.carousel.css')}}" rel="stylesheet">
    <!-- Page level plugin styles END -->

    <!-- Theme styles START -->
    @if(\Request::route()->getName() != 'pindelta::contact')
    <link href="{{ URL::asset('template/pages/css/components.css')}}" rel="stylesheet">
    @endif
    <link href="{{ URL::asset('template/pages/css/slider.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('template/pages/css/style-shop.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('template/corporate/css/style.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('template/corporate/css/style-responsive.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('template/corporate/css/themes/red.css')}}" rel="stylesheet" id="style-color">
    <link href="{{ URL::asset('template/corporate/css/custom.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('css/pindelta.css')}}" rel="stylesheet">
    <!-- Theme styles END -->

    <link href="{{ URL::asset('js/sweet-alert2/css/sweet-alert2.min.css')}}" rel="stylesheet" >
</head>
<!-- Head END -->