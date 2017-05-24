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
    <!-- END PAGE LEVEL JAVASCRIPTS -->
</body>
<!-- END BODY -->
@yield('foot')
</html>