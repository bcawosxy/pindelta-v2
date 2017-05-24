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
            <!-- BEGIN SIDEBAR & CONTENT -->
            <div class="row margin-bottom-40">

                <!-- BEGIN SIDEBAR -->
                <div class="sidebar col-md-3 col-sm-3">
                    <h2>Our Contacts</h2>
                    <address>
                        35, Lorem Lis Street, Park Ave<br>
                        California, US<br>
                        <abbr title="Phone">P:</abbr> 300 323 3456<br>
                    </address>
                    <address>
                        <strong>Email</strong><br>
                        <a href="mailto:info@metronic.com">info@metronic.com</a><br>
                        <a href="mailto:support@metronic.com">support@metronic.com</a>
                    </address>
                    <ul class="social-icons margin-bottom-10">
                        <li><a href="javascript:;" data-original-title="facebook" class="facebook"></a></li>
                        <li><a href="javascript:;" data-original-title="github" class="github"></a></li>
                        <li><a href="javascript:;" data-original-title="Goole Plus" class="googleplus"></a></li>
                        <li><a href="javascript:;" data-original-title="linkedin" class="linkedin"></a></li>
                        <li><a href="javascript:;" data-original-title="rss" class="rss"></a></li>
                    </ul>
                </div>
                <!-- END SIDEBAR -->

                <!-- BEGIN CONTENT -->
                <div class="col-md-9 col-sm-9">
                    <div class="content-page">

                        <h2>Contact Form</h2>
                        <p>Want to say hello? Want to know more about us? To inquire about the products and services found on our website, drop us an email and we will get back to you as soon as we can. We'll gladly assist you. </p>
                        <p>(<span class="require">*</span> Required field)</p>

                        <!-- BEGIN FORM-->
                        <form action="#" class="default-form" role="form">
                            <div class="form-group">
                                <label for="firstName">First Name</label>
                                <input type="text" class="form-control" id="firstName">
                            </div>
                            <div class="form-group">
                                <label for="lastName">Last Name</label>
                                <input type="text" class="form-control" id="lastName">
                            </div>
                            <div class="form-group">
                                <label for="email">Email <span class="require">*</span></label>
                                <input type="text" class="form-control" id="email">
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
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
                                <button type="submit" class="btn btn-primary">Submit</button>
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
    </script>
@endsection