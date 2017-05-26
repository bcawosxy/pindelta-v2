@yield('head')

<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
    <div class="wrapper">
        @yield('header')
        @yield('navbar')

        @yield('content')

        <footer class="main-footer">
            <strong>Copyright &copy; 2015-2016 <a href="#"> Memorable Supplier</a>.</strong> All rights reserved.
        </footer>
    </div>

    <script src="{{ URL::asset('adminlte/js/jquery_2.1.4.min.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('adminlte/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('adminlte/adminlte/js/app.min.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('adminlte/adminlte/js/demo.js')}}" type="text/javascript"></script>

</body>
@yield('foot')
</html>