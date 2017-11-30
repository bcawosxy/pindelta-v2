@extends('layout.pindelta.master')

@section('head')
    @include('layout.pindelta.head')
@endsection

@section('header')
    @include('layout.pindelta.header')
@endsection

@section('content')
  <style>
    .row {
      margin-top: 5px;
    }
  </style>
<div class="main">
      <div class="container">
        <ul class="breadcrumb">
            <li><a href="<?php echo  url()->route('pindelta::index'); ?>">Home</a></li>
            <li><a href="<?php echo  url()->route('pindelta::categoryarea', ['id'=>$data['product']['cg_id']]); ?>"><?php echo $data['product']['cg_name'] ?></a></li>
            <li><a href="<?php echo  url()->route('pindelta::category', ['id'=>$data['product']['c_id']]); ?>"><?php echo $data['product']['c_name'] ?></a></li>
            <li class="active"><?php echo $data['product']['name'] ?></li>
        </ul>

        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">
          <!-- BEGIN SIDEBAR -->
            @include('sidebar')
          <!-- END SIDEBAR -->

          <!-- BEGIN CONTENT -->
          <div class="col-md-9 col-sm-7">
            <div class="product-page">
              <div class="row">

                <div class="col-md-6 col-sm-6">
                  <div class="product-main-image">
                    <img src="<?php echo asset("storage/images/product/".$data['product']['cover']) ?>" alt="<?php echo $data['product']['name'] ?>" class="img-responsive">
                  </div>
                </div>

                <div class="col-md-6 col-sm-6">
                  <h1><?php echo $data['product']['name'] ?></h1>
                  <div class="row">
                    <div class="col-md-5 col-sm-6 datasheet-features-type"> Item Number : </div>
                    <div class="col-md-7 col-sm-6"> <?php echo $data['product']['model'] ?> </div>
                  </div>
                  <div class="row">
                    <div class="col-md-5 col-sm-6 datasheet-features-type"> Size :  </div>
                    <div class="col-md-7 col-sm-6"> <?php echo $data['product']['standard'] ?> </div>
                  </div>
                  <div class="row">
                    <div class="col-md-5 col-sm-6 datasheet-features-type"> Material :  </div>
                    <div class="col-md-7 col-sm-6"> <?php echo $data['product']['material'] ?> </div>
                  </div>
                  <div class="row">
                    <div class="col-md-5 col-sm-6 datasheet-features-type"> Production Time : </div>
                    <div class="col-md-7 col-sm-6"> <?php echo $data['product']['produce_time'] ?> </div>
                  </div>
                  <div class="row">
                    <div class="col-md-5 col-sm-6 datasheet-features-type"> MOQ : </div>
                    <div class="col-md-7 col-sm-6"> <?php echo $data['product']['lowest'] ?> </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12 col-sm-12 datasheet-features-type"> Memo </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12 col-sm-12"> <?php echo $data['product']['memo'] ?> </div>
                  </div>

                  <hr>
                  <ul class="social-icons">
                    <li><a class="facebook" data-original-title="facebook" href="javascript:;"></a></li>
                    <li><a class="twitter" data-original-title="twitter" href="javascript:;"></a></li>
                    <li><a class="googleplus" data-original-title="googleplus" href="javascript:;"></a></li>
                    <li><a class="evernote" data-original-title="evernote" href="javascript:;"></a></li>
                    <li><a class="tumblr" data-original-title="tumblr" href="javascript:;"></a></li>
                  </ul>
                </div>

                <div class="product-page-content">
                  <ul id="myTab" class="nav nav-tabs">
                    <li class="active"><a href="#Description" data-toggle="tab">Description</a></li>
                    <li><a href="#Reviews" data-toggle="tab">Request Quote</a></li>
                  </ul>
                  <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade in active" id="Description">
                      <p><?php echo $data['product']['description'] ?></p>
                    </div>
                    <div class="tab-pane fade " id="Reviews">
                      <!-- BEGIN FORM-->
                      <form style="" action="#" class="reviews-form" role="form">
                        <h2>Write a review</h2>
                        <div style="border:1px solid #dadada;padding:10px;">
                          <div class="row">
                            <div class="form-group col-md-4">
                              <label for="name">First Name <span class="require">*</span></label>
                              <input type="text" class="form-control" id="name">
                            </div>
                            <div class="form-group col-md-4">
                              <label for="name">Last Name <span class="require">*</span></label>
                              <input type="text" class="form-control" id="name">
                            </div>
                            <div class="form-group col-md-4">
                              <label for="name">Email <span class="require">*</span></label>
                              <input type="text" class="form-control" id="name">
                            </div>
                          </div>

                          <div class="row">
                            <div class="form-group col-md-4">
                              <label for="name">Quantity <span class="require">*</span></label>
                              <input type="text" class="form-control" id="name">
                            </div>
                            <div class="form-group col-md-4">
                              <label for="name">Country <span class="require">*</span></label>
                              <input type="text" class="form-control" id="name">
                            </div>
                            <div class="form-group col-md-4">
                              <label for="name">Company <span class="require">*</span></label>
                              <input type="text" class="form-control" id="name">
                            </div>
                          </div>

                          <div class="row">
                            <div class="form-group col-md-8">
                              <label for="name">Website <span class="require">*</span></label>
                              <input type="text" class="form-control" id="name">
                            </div>
                            <div class="form-group col-md-4">
                              <label for="name">Logo Request <span class="require">*</span></label>
                              <input type="text" class="form-control" id="name">
                            </div>
                          </div>

                          <div class="row">
                            <div class="form-group col-md-12">
                              <label for="name">Message <span class="require">*</span></label>
                              <textarea class="form-control"></textarea>
                            </div>
                          </div>

                          <div class="row">
                            <div class="form-group col-md-8">
                              <label for="name">Please enter the Verification Code <span class="require">*</span></label>
                              <input type="text" class="form-control" id="name">
                            </div>
                            <div class="form-group col-md-4">
                              <label for="name">Name <span class="require">*</span></label>
                              <input type="text" class="form-control" id="name">
                            </div>
                          </div>

                          <div class="padding-top-20">
                            <button type="submit" class="btn btn-primary">Send</button>
                          </div>
                        </div>
                      </form>
                      <!-- END FORM-->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- END CONTENT -->
        </div>
        <!-- END SIDEBAR & CONTENT -->

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