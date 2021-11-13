<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('admin_assets/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- IonIcons -->
    <link rel="stylesheet" href="{{asset('admin_assets/plugins/toastr/toastr.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin_assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('admin_assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin_assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin_assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
    <!-- Theme style -->
    <!-- summernote -->
    <link rel="stylesheet" href="{{asset('admin_assets/plugins/summernote/summernote-bs4.min.css')}}">

    <link rel="stylesheet" href="{{asset('admin_assets/dist/css/adminlte.min.css')}}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('admin_assets/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin_assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="{{asset('admin_assets/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css')}}">

    @livewireStyles

</head>

<body class="hold-transition sidebar-mini">

    <?php

    $companyinfo = DB::table('companies')->first();

    ?>
    <div class="wrapper">
        <!-- Navbar -->
        @include('admin/include/topbar')
        <!-- Sidebar Menu -->
        @include('admin/include/menu')
        <!-- /.sidebar-menu -->
        <div class="content-wrapper">
            @yield('content')
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>

        @include('admin/include/footer')
    </div>
    <!-- media model -->
    <div class="modal fade" id="modal-xl">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active btn-flat" href="#select" data-toggle="tab">Select File</a></li>
                        <li class="nav-item"><a class="nav-link btn-flat" href="#uplodes" data-toggle="tab">Upload New</a></li>
                    </ul>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="tab-content" style="min-height: 400px;">
                        <div class="active tab-pane" id="select">
                            222
                        </div>

                        <div class=" tab-pane" id="uplodes">

                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- jQuery -->
    <script src="{{asset('admin_assets/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Select2 -->
    <script src="{{asset('admin_assets/plugins/select2/js/select2.full.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('admin_assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE -->
    <script src="{{asset('admin_assets/dist/js/adminlte.js')}}"></script>
    <script src="{{asset('admin_assets/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
    <!-- Toastr -->
    <script src="{{asset('admin_assets/plugins/toastr/toastr.min.js')}}"></script>
    <!-- OPTIONAL SCRIPTS -->
    <script src="{{asset('admin_assets/plugins/chart.js/Chart.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('admin_assets/dist/js/demo.js')}}"></script>
    <script src="{{asset('admin_assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{asset('admin_assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin_assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('admin_assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('admin_assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('admin_assets/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('admin_assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('admin_assets/plugins/jszip/jszip.min.js')}}"></script>
    <script src="{{asset('admin_assets/plugins/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{asset('admin_assets/plugins/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{asset('admin_assets/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('admin_assets/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('admin_assets/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
    <script>
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    </script>
    <!-- Summernote -->
    <script src="{{asset('admin_assets/plugins/summernote/summernote-bs4.min.js')}}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script>
        //Initialize Select2 Elements
        $('.select2').select2()


        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });
    </script>
    <script>
        // Summernote
        $('#summernote').summernote()
    </script>
    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>
    @include('sweetalert::alert')
    @livewireScripts
    <script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
    @yield('script')

</body>

</html>