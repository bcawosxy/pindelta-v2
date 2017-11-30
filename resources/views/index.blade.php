@extends('layout.pindelta.master')
@section('head')
    @include('layout.pindelta.head')
@endsection
@section('header')
    @include('layout.pindelta.header')
@endsection
@section('content')
    <style>
        .page-load-status {
            display: none; /* hidden by default */
            padding-top: 20px;
            border-top: 1px solid #DDD;
            text-align: center;
            color: #777;
        }
    </style>
    <div class="main">
        <div class="container">
            <div class="row margin-bottom-40">
                <!-- BEGIN CONTENT -->
                <div class="col-md-12 col-sm-12">
                    <!-- BEGIN PRODUCT LIST -->
                    <div class="row product-list">
                        <!-- PRODUCT ITEM START -->
                        @if($data['categoryarea'])
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
                        @else
                            <div class="col-md-12ths col-sm-12 col-xs-12 item">
                                <div class="product-item">
                                    <h3><a href="#">目前沒有任何商品</a></h3>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="page-load-status">
                        <p class="infinite-scroll-request">Loading...</p>
                        <p class="infinite-scroll-last">End of content</p>
                        <p class="infinite-scroll-error">No more pages to load</p>
                    </div>
                    <!-- END PRODUCT LIST -->
                </div>
                <!-- END CONTENT -->
            </div>
        </div>
    </div>

    <a class="pagination__next" href="/index/2"></a>
@endsection

@section('footer')
    @include('layout.pindelta.footer')
@endsection

@section('foot')
    <script type="text/javascript">
        var $grid = $('.product-list').masonry({
            // Masonry options...
            gutter : 0,
            itemSelector: '.item',
            horizontalOrder: true
        });

        // get Masonry instance
        var msnry = $grid.data('masonry');

        $grid.infiniteScroll({
            // Infinite Scroll options...
            path: '.pagination__next',
            append: '.item',
            outlayer: msnry,
            history: false,
            status: '.page-load-status',
            onInit: function() {
                this.on( 'load', function() {});
            }
        });

    </script>
@endsection