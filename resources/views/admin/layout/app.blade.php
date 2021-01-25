<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ $setting->store_name ?? '' }} | @yield('title') </title>

    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/admin/dist/css/adminlte.min.css') }}">
    <!-- Custom css -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">

     <!-- Date Picker CSS -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/datepicker.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="shortcut icon" href="{{ $setting->favicon_image ?? null}}"/>

    <!-- Select 2 CSS -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2/css/select2.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('assets/admin/plugins/lightbox/simple-lightbox.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/ekko-lightbox/ekko-lightbox.css') }}">

    <link href="{{ asset('assets/admin/plugins/kartik-v-bootstrap-fileinput/css/fileinput.css') }}" media="all" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/admin/plugins/kartik-v-bootstrap-fileinput/themes/explorer-fas/theme.css') }}" media="all" rel="stylesheet" type="text/css"/>
    <style type="text/css">
        .grey-bg {
            background-color: #e9ecef;
        }

        .table td,
        .table th {
            vertical-align: middle;
        }

        .lds-ellipsis {
            display: inline-block;
            position: relative;
            width: 80px;
            height: 80px;
        }

        .lds-ellipsis div {
            position: absolute;
            top: 33px;
            width: 13px;
            height: 13px;
            border-radius: 50%;
            background: rgb(31, 99, 216);
            animation-timing-function: cubic-bezier(0, 1, 1, 0);
        }

        .lds-ellipsis div:nth-child(1) {
            left: 8px;
            animation: lds-ellipsis1 0.6s infinite;
        }

        .lds-ellipsis div:nth-child(2) {
            left: 8px;
            animation: lds-ellipsis2 0.6s infinite;
        }

        .lds-ellipsis div:nth-child(3) {
            left: 32px;
            animation: lds-ellipsis2 0.6s infinite;
        }

        .lds-ellipsis div:nth-child(4) {
            left: 56px;
            animation: lds-ellipsis3 0.6s infinite;
        }
        label.error{
          font-weight: 500 !important;
        }
        @keyframes lds-ellipsis1 {
            0% {
                transform: scale(0);
            }

            100% {
                transform: scale(1);
            }
        }

        @keyframes lds-ellipsis3 {
            0% {
                transform: scale(1);
            }

            100% {
                transform: scale(0);
            }
        }

        @keyframes lds-ellipsis2 {
            0% {
                transform: translate(0, 0);
            }

            100% {
                transform: translate(24px, 0);
            }
        }
        .select2-container--bootstrap4 .select2-selection__clear {
            background-color: #ffffff !important;
            color: #0b0b0b !important;
            margin-top: 10px !important;;
        }

    </style>
    <script>
        window.Laravel = @json([
            'csrfToken' => csrf_token(),
        ]);

    </script>

    @stack('css')

    @stack('style')

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper" id="app">
        <!-- Navbar -->
        @include('admin.layout.header')
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        @include('admin.layout.sidebar')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-10">
                            <h1 class="m-0 text-dark">@yield('page_title')</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-2">
                            @yield('button')
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <!-- Control Sidebar -->

        <!-- /.control-sidebar -->
        <!-- Main Footer -->
        @include('admin.layout.footer')
    </div>
    <!-- ./wrapper -->
    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="{{ asset('assets/admin/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/datatables/jquery.dataTables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/admin/dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/jquery-validation/additional-methods.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/admin/plugins/lightbox/simple-lightbox.js') }}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>
    <script src="{{ asset('assets/admin/js/action.js') }}"></script>
    <script src="{{ asset('assets/admin/js/sweetalert2.all.min.js') }}"></script>
     <!-- Date Picker Js -->
    <script src="{{ asset('assets/admin/js/datepicker.min.js') }}"></script>
    <!-- Select 2 Js -->
    <script src="{{ asset('assets/admin//plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/select2/js/select2.full.js') }}" type="text/javascript"></script>

   <script src="{{ asset('assets/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
      <!-- AdminLTE for demo purposes -->
    {{--  <script src="{{ asset('assets/admin/dist/js/demo.js')}}"></script> --}}

    <script>
        const lodingImage = '<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>';

        const toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 8000
        });

        const message = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success shadow-sm mr-2',
                cancelButton: 'btn btn-danger shadow-sm'
            },
            buttonsStyling: false,
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        @if(Session::has('error'))
        message.fire({
            type: 'error',
            title: 'Error',
            text: "{!!  session('error')  !!}"
        });
        @php
          session()->forget('error');
        @endphp
        @endif
            @if(Session::has('success'))
                message.fire({
                    type: 'success',
                    title: 'Success',
                    text: "{!!  session('success')  !!}"
                });
            @php
              session()->forget('success')
            @endphp
        @endif

    </script>

    @stack('js')

    <script>
        if(jQuery.datetimepicker){
            $.fn.datetimepicker.Constructor.Default = $.extend({}, $.fn.datetimepicker.Constructor.Default, {
            icons: {
                time: 'far fa-clock',
                date: 'far fa-calendar',
                up: 'far fa-arrow-up',
                down: 'far fa-arrow-down',
                previous: 'far fa-chevron-left',
                next: 'far fa-chevron-right',
                today: 'far fa-calendar-check-o',
                clear: 'far fa-trash',
                close: 'far fa-times'
            } });
        }


        $('.commonDatepicker').datepicker({
                            language: {
                              days: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
                              daysShort: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
                              daysMin: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                              months: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                              monthsShort: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                              today: 'Today',
                              clear: 'Clear',
                              dateFormat: 'dd-mm-yyyy',
                              firstDay: 0
                            }
        });
    </script>

    <script>
        $(function () {
        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox({
            alwaysShowClose: true
            });
        });

        // $('.filter-container').filterizr({gutterPixels: 3});
        $('.btn[data-filter]').on('click', function() {
            $('.btn[data-filter]').removeClass('active');
            $(this).addClass('active');
        });
        })
    </script>

    @stack('scripts')


    {{-- Bootstrep Krajee JS  --}}
    <script src="{{ asset('assets/admin/plugins/kartik-v-bootstrap-fileinput/js/plugins/piexif.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/plugins/kartik-v-bootstrap-fileinput/js/plugins/sortable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/plugins/kartik-v-bootstrap-fileinput/js/fileinput.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/plugins/kartik-v-bootstrap-fileinput/js/locales/fr.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/plugins/kartik-v-bootstrap-fileinput/js/locales/es.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/plugins/kartik-v-bootstrap-fileinput/themes/fas/theme.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/plugins/kartik-v-bootstrap-fileinput/themes/explorer-fas/theme.js') }}" type="text/javascript"></script>

   
</body>

</html>
