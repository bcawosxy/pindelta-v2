@extends('layout.pindelta.master')

@section('head')
    @include('layout.pindelta.head')
@endsection

@section('header')
    @include('layout.pindelta.header')
@endsection

@section('content')
    <style>
        .redBorder {
            border : red 1px solid !important;
        }
    </style>
    <div class="main">
        <div class="container">
            <!-- BEGIN SIDEBAR & CONTENT -->
            <div class="row margin-bottom-40">
                <!-- BEGIN SIDEBAR -->
                <div class="sidebar col-md-3 col-sm-3">
                    <h2>Our Contacts</h2>
                    <address>
                        <strong>Phone</strong><br>
                        {{ $data['contact']['office_info_phone'] }}
                    </address>
                    <address>
                        <strong>Email</strong><br>
                        <a href="mailto:{{ $data['contact']['office_info_email'] }}">{{ $data['contact']['office_info_email'] }}</a><br>
                    </address>
                    <!--
                    <ul class="social-icons margin-bottom-10">
                        <li><a href="javascript:;" data-original-title="facebook" class="facebook"></a></li>
                        <li><a href="javascript:;" data-original-title="github" class="github"></a></li>
                        <li><a href="javascript:;" data-original-title="Goole Plus" class="googleplus"></a></li>
                        <li><a href="javascript:;" data-original-title="linkedin" class="linkedin"></a></li>
                        <li><a href="javascript:;" data-original-title="rss" class="rss"></a></li>
                    </ul>
                    -->
                </div>
                <!-- END SIDEBAR -->

                <!-- BEGIN CONTENT -->
                <div class="col-md-9 col-sm-9">
                    <div class="content-page">

                        <h2>Contact Form</h2>
                        <p>Want to say hello? Want to know more about us? To inquire about the products and services found on our website, drop us an email and we will get back to you as soon as we can. We'll gladly assist you. </p>
                        <p>(<span class="require">*</span> Required field)</p>

                        <!-- BEGIN FORM-->
                        <form class="default-form" role="form">
                            <div class="form-group">
                                <label for="firstName">First Name <span class="require">*</span></label>
                                <input type="text" class="form-control" id="firstName">
                            </div>
                            <div class="form-group">
                                <label for="lastName">Last Name <span class="require">*</span></label>
                                <input type="text" class="form-control" id="lastName">
                            </div>
                            <div class="form-group">
                                <label for="email">Email <span class="require">*</span></label>
                                <input type="text" class="form-control" id="email">
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone <span class="require">*</span></label>
                                <input type="text" class="form-control" id="phone">
                            </div>
                            <div class="form-group">
                                <label for="fax">Fax</label>
                                <input type="text" class="form-control" id="fax">
                            </div>
                            <div class="form-group">
                                <label for="companyName">Company Name</label>
                                <input type="text" class="form-control" id="companyName">
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" id="address">
                            </div>
                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea class="form-control" rows="8" id="message"></textarea>
                            </div>
                            <div class="padding-top-20">
                                <button type="button" id="save" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                        <!-- END FORM-->
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
        $(function () {
            for (let value of ['firstName', 'lastName', 'email' ,'phone', 'message']) {
                $('#'+value).on('click', function () {
                    $(this).removeClass('redBorder');
                })
            }
        });
        
        function checkValue(obj) {
            for (let value of obj) {
                if(!$('#'+value).val().length) {
                    $('#'+value).addClass('redBorder').attr('placeholder', '請填寫資料').focus();
                    return false;
                }
            }
            return true;
        }

        $('#save').on('click', function() {
            if(checkValue(['firstName', 'lastName', 'email' ,'phone', 'message'])) {
                $.ajax({
                    url: '{{url("/contact/add")}}',
                    type: 'post',
                    data: {
                        first_name: $('#firstName').val(),
                        last_name: $('#lastName').val(),
                        tel: $('#phone').val(),
                        fax: $('#fax').val(),
                        company: $('#companyName').val(),
                        email: $('#email').val(),
                        address: $('#address').val(),
                        memo: $('#message').val(),
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
            }
        });
    </script>
@endsection