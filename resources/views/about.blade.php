@extends('layout.pindelta.master')

@section('head')
    @include('layout.pindelta.head')
@endsection

@section('header')
    @include('layout.pindelta.header')
@endsection

@section('content')
    <div class="main">
        <div class="container">
            <div class="row margin-bottom-40">
                <!-- BEGIN CONTENT -->
                <div class="col-md-12 col-sm-12">
                    <h1>About us</h1>
                    <div class="content-page">
                        {!! $data['value'] !!}
                    </div>
                </div>
                <!-- END CONTENT -->
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @include('layout.pindelta.footer')
@endsection

@section('foot')
    <script type="text/javascript">
    </script>
@endsection