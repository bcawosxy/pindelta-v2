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
            <ul class="breadcrumb">
                <li><a href="index.html">Home</a></li>
                <li><a href="">Store</a></li>
                <li class="active">Men category</li>
            </ul>
            <!-- BEGIN SIDEBAR & CONTENT -->
            <div class="row margin-bottom-40">
                <!-- BEGIN SIDEBAR -->
                <div class="sidebar col-md-3 col-sm-5">
                    <ul class="list-group margin-bottom-25 sidebar-menu">
                        <?php
                            foreach ( $data['sidebar'] as $k0 => $v0 ) {
                            	$active1 = ($data['activeCategoryarea_id'] == $v0['categoryarea_id']) ? 'active' : null;
                                $display = ($data['activeCategoryarea_id'] == $v0['categoryarea_id']) ? 'display:block' : 'display:none';
								echo '<li class="list-group-item clearfix '.$active1.' ">
                                            <a href="'.url()->route('pindelta::categoryarea', ['id'=>$v0['categoryarea_id']]).'"><i class="fa fa-angle-right"></i>'.$v0['categoryarea_name'].'</a>
                                            <ul class="dropdown-menu" style="'.$display.'">';
                                                foreach ( $v0['category'] as $k1 => $v1) {
                                                    echo '<li><a href="javascript:void(0);"><i class="fa fa-caret-right"></i>'.$v1['category_name'].'</a></li>';
                                                }
                                            echo '</ul>
                                    </li>';
                         }
                        ?>
                    </ul>
                </div>
                <!-- END SIDEBAR -->

                <!-- BEGIN CONTENT -->
                <div class="col-md-9 col-sm-7">
                    <?php
                        foreach ($data['category'] as $k0 => $v0) {
                        	if ($k0%5 == 0) echo '<div class="row product-list">';
                        	echo '<div class="col-md-5ths col-sm-3 col-xs-4">
                                <div class="product-item">
                                    <div class="pi-img-wrapper">
                                        <img src="'.$v0['cover'].'" class="img-responsive">
                                        <div>
                                            <a href="'.$v0['cover'].'" class="btn btn-default fancybox-button">Zoom</a>
                                        </div>
                                    </div>
                                    <h3><a href="#">'.$v0['name'].'</a></h3>
                                    <div class="pi-price pi-description">123</div>
                                </div>
                            </div>';

							if ($k0%5 == 4 || (count($data['category'])-1) == $k0 ) echo '</div>';
                        }
                    ?>
                </div>
                <!-- END CONTENT -->
            </div>
            <!-- END SIDEBAR & CONTENT -->
        </div>
    </div>

    <a class="pagination__next" href="/categoryarea/2"></a>
@endsection

@section('footer')
    @include('layout.pindelta.footer')
@endsection

@section('foot')
    <script type="text/javascript">
//        var $grid = $('.product-list').masonry({
//            // Masonry options...
//            gutter : 0,
//            itemSelector: '.item',
//            horizontalOrder: true
//        });
//
//        // get Masonry instance
//        var msnry = $grid.data('masonry');
//
//        $grid.infiniteScroll({
//            // Infinite Scroll options...
//            path: '.pagination__next',
//            append: '.item',
//            outlayer: msnry,
//            history: false,
//            status: '.page-load-status',
//            onInit: function() {
//                this.on( 'load', function() {});
//            }
//        });

    </script>
@endsection