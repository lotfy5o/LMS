<!DOCTYPE html>
<html lang="en">

    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <meta name="author" content="TechyDevs">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <title>Aduca - Education HTML Template</title>

        <!-- Google fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link
            href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800&display=swap"
            rel="stylesheet">

        <!-- Favicon -->
        <link rel="icon" sizes="16x16" href="{{ asset('asset-front') }}/images/favicon.png">

        <!-- inject:css -->
        <link rel="stylesheet" href="{{ asset('asset-front') }}/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{ asset('asset-front') }}/css/line-awesome.css">
        <link rel="stylesheet" href="{{ asset('asset-front') }}/css/owl.carousel.min.css">
        <link rel="stylesheet" href="{{ asset('asset-front') }}/css/owl.theme.default.min.css">
        <link rel="stylesheet" href="{{ asset('asset-front') }}/css/bootstrap-select.min.css">
        <link rel="stylesheet" href="{{ asset('asset-front') }}/css/fancybox.css">
        <link rel="stylesheet" href="{{ asset('asset-front') }}/css/style.css">
        <!-- end inject -->

        {{-- Toaster for Messages --}}
        <link rel="stylesheet" type="text/css"
            href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
        <title>Rocker - Bootstrap 5 Admin Dashboard Template</title>
    </head>

    <body>

        <!-- start cssload-loader -->
        <div class="preloader">
            <div class="loader">
                <svg class="spinner" viewBox="0 0 50 50">
                    <circle class="path" cx="25" cy="25" r="20" fill="none"
                        stroke-width="5"></circle>
                </svg>
            </div>
        </div>
        <!-- end cssload-loader -->

        <!--======================================
        START HEADER AREA
    ======================================-->
        @include('frontend.dashboard.partials.header')
        <!-- end header-menu-area -->
        <!--======================================
        END HEADER AREA
======================================-->

        <!-- ================================
    START DASHBOARD AREA
================================= -->
        <section class="dashboard-area">
            <div
                class="off-canvas-menu dashboard-off-canvas-menu off--canvas-menu custom-scrollbar-styled pt-20px">
                <div class="off-canvas-menu-close dashboard-menu-close icon-element icon-element-sm shadow-sm"
                    data-toggle="tooltip" data-placement="left" title="Close menu">
                    <i class="la la-times"></i>
                </div><!-- end off-canvas-menu-close -->
                @include('frontend.dashboard.partials.sidebar')
            </div><!-- end off-canvas-menu -->
            <div class="dashboard-content-wrap">
                @yield('content')
            </div><!-- end dashboard-content-wrap -->
        </section>
        <!-- end dashboard-area -->
        <!-- ================================
    END DASHBOARD AREA
================================= -->

        <!-- start scroll top -->
        <div id="scroll-top">
            <i class="la la-arrow-up" title="Go top"></i>
        </div>
        <!-- end scroll top -->

        <!-- Modal -->
        <div class="modal fade modal-container" id="deleteModal" tabindex="-1" role="dialog"
            aria-labelledby="deleteModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <span class="la la-exclamation-circle fs-60 text-warning"></span>
                        <h4 class="modal-title fs-19 font-weight-semi-bold pt-2 pb-1"
                            id="deleteModalTitle">Your account
                            will be deleted permanently!</h4>
                        <p>Are you sure you want to delete your account?</p>
                        <div class="btn-box pt-4">
                            <button type="button" class="btn font-weight-medium mr-3"
                                data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn theme-btn theme-btn-sm lh-30">Ok,
                                Delete</button>
                        </div>
                    </div><!-- end modal-body -->
                </div><!-- end modal-content -->
            </div><!-- end modal-dialog -->
        </div><!-- end modal -->


        <!-- template js files -->

        @include('frontend.dashboard.partials.scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


    </body>

</html>
