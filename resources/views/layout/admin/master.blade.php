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
    <script src="{{ URL::asset('adminlte/plugins/slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('adminlte/plugins/fastclick/fastclick.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('adminlte/plugins/datatables/jquery.dataTables.min.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('adminlte/plugins/datatables/dataTables.bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('adminlte/plugins/icheck/icheck.min.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('js/jquery-file-upload/js/jquery.ui.widget.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('js/jquery-file-upload/js/jquery.iframe-transport.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('js/jquery-file-upload/js/jquery.fileupload.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('adminlte/plugins/select2/select2.full.min.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('js/sweet-alert2/js/sweet-alert2.min.js')}}" type="text/javascript"></script>

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
            'timer': 2000,
        }).then(
            function () { if(r.redirect) location.href = r.redirect; },
            function (dismiss) { if(r.redirect) location.href = r.redirect; }
        ).catch(swal.noop);
    }
</script>
@yield('foot')
</html>