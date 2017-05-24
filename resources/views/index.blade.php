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
                        <div class="col-md-5ths col-sm-3 col-xs-4">
                            <div class="product-item">
                                <div class="pi-img-wrapper">
                                    <img src="images/list1.jpg" class="img-responsive" alt="Berry Lace Dress">
                                    <div></div>
                                </div>
                                <h3><a href="shop-item.html">3D Stickers</a></h3>
                                <div class="pi-price pi-description">Carcorder/Car Charger/Car Vacuum Cleaner/Magnet Car Air Vent Holder</div>
                            </div>
                        </div>
                        <!-- PRODUCT ITEM END -->
                        <!-- PRODUCT ITEM START -->
                        <div class="col-md-5ths col-sm-3 col-xs-4">
                            <div class="product-item">
                                <div class="pi-img-wrapper">
                                    <img src="images/list2.jpg" class="img-responsive" alt="Berry Lace Dress">
                                    <div></div>
                                </div>
                                <h3><a href="shop-item.html">3C RELATED PRODUCTS/ACCESSORIES</a></h3>
                                <div class="pi-price pi-description">Carcorder/Car Charger/Car Vacuum Cleaner/Magnet Car Air Vent Holder</div>
                            </div>
                        </div>
                        <!-- PRODUCT ITEM END -->
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

    </script>
@endsection