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
                    <!-- BEGIN PRODUCT LIST -->
                    <div class="row product-list">
                        <!-- PRODUCT ITEM START -->
                        @foreach($data['categoryarea'] as $k0 => $v0)
                            <div class="col-md-5ths col-sm-3 col-xs-4 item">
                                <div class="product-item">
                                    <div class="pi-img-wrapper">
                                        <img src="{{ $v0['cover']  }}" class="img-responsive" alt="Berry Lace Dress">
                                        <div></div>
                                    </div>
                                    <h3><a href="{{ $v0['url'] }}">{{$v0['name']}}</a></h3>
                                    <div class="pi-price pi-description">{{$v0['description']}}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- END PRODUCT LIST -->
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
        $('.product-list').infiniteScroll({
            // options
            path: '.pagination__next',
            append: '.item',
            history: false,
        });
    </script>
@endsection