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
                <li><a href="<?php echo  url()->route('pindelta::index'); ?>">Home</a></li>
                <li class="active"><?php echo $data['categoryarea']['name'] ?></li>
            </ul>

            <!-- BEGIN SIDEBAR & CONTENT -->
            <div class="row margin-bottom-40">
                <!-- BEGIN SIDEBAR -->
                    @include('sidebar')
                <!-- END SIDEBAR -->

                <!-- BEGIN CONTENT -->
                <div class="col-md-9 col-sm-7">
                    <?php
                        foreach ($data['category'] as $k0 => $v0) {
                        	if ($k0%5 == 0) echo '<div class="row product-list">';
                        	echo '<div class="col-md-5ths col-sm-3 col-xs-4">
                                <div class="product-item">
                                    <div class="pi-img-wrapper">
                                        <a href="'.url()->route('pindelta::category', ['cg_id'=>$data['activeCategoryarea_id'] , 'id'=>$v0['id']]).'"><img src="'.$v0['cover'].'" class="img-responsive"></a>
                                    </div>
                                    <h3><a href="'.url()->route('pindelta::category', ['cg_id'=>$data['activeCategoryarea_id'] , 'id'=>$v0['id']]).'">'.$v0['name'].'</a></h3>
                                    <div class="pi-price pi-description">
                                        '.$v0['description'].'
                                    </div>
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

    </script>
@endsection