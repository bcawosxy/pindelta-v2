@yield('head')
<!-- Body BEGIN -->
<body class="ecommerce">
    <!-- BEGIN HEADER -->
    @yield('header')
    <!-- Header END -->

    <!-- BEGIN content -->
    @yield('content')
    <!-- END content-->

    <!-- BEGIN FOOTER -->
    @yield('footer')
    <!-- END FOOTER -->

    <!-- Load javascripts at bottom, this will reduce page load time -->
    <!-- BEGIN CORE PLUGINS (REQUIRED FOR ALL PAGES) -->
    <!--[if lt IE 9]>
    <script src="template/plugins/respond.min.js"></script>
    <![endif]-->
    <script src="template/plugins/jquery.min.js" type="text/javascript"></script>
    <script src="template/plugins/jquery-migrate.min.js" type="text/javascript"></script>
    <script src="template/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="template/corporate/scripts/back-to-top.js" type="text/javascript"></script>
    <script src="template/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->

    <!-- BEGIN PAGE LEVEL JAVASCRIPTS (REQUIRED ONLY FOR CURRENT PAGE) -->
    <script src="template/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script><!-- pop up -->
    <script src="template/plugins/owl.carousel/owl.carousel.min.js" type="text/javascript"></script><!-- slider for products -->
    <script src='template/plugins/zoom/jquery.zoom.min.js' type="text/javascript"></script><!-- product zoom -->
    <script src="template/plugins/bootstrap-touchspin/bootstrap.touchspin.js" type="text/javascript"></script><!-- Quantity -->

    <script src="template/corporate/scripts/layout.js" type="text/javascript"></script>
    <script src="template/pages/scripts/bs-carousel.js" type="text/javascript"></script>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            Layout.init();
            Layout.initOWL();
            Layout.initImageZoom();
            Layout.initTouchspin();
            Layout.initTwitter();
            Layout.initFixHeaderWithPreHeader();
            Layout.initNavScrolling();
        });
    </script>
    <script src="{{ URL::asset('js/sweet-alert2/js/sweet-alert2.min.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('js/infinite-scroll/infinite-scroll.pkgd.min.js')}}" type="text/javascript"></script>
    <!-- END PAGE LEVEL JAVASCRIPTS -->
</body>
<script>
    function _swal(r) {
        switch (r.status) {
            case 0 : status = 'error'; break;
            case 2 : status = 'warning'; break;
            case 3 : status = 'info'; break;
            case 4 : status = 'question'; break;
            default : status = 'success'; break;
        }

        swal({
            'text' : r.message,
            'type' : status,
            'timer': 5000,
        }).then(
            function () { if(r.redirect) location.href = r.redirect; },
            function (dismiss) { if(r.redirect) location.href = r.redirect; }
        ).catch(swal.noop);
    }
</script>
<!-- END BODY -->
@yield('foot')
</html>