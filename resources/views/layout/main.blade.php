@include('layout.inc.header')
    <!-- Page Wrapper-->
    <div class="page-wrapper">
            @include('layout.inc.sidebar')
        <div class="page-container">
            @include('layout.inc.topbar')
            <!-- MAIN CONTENT-->
            <div id="main" class="main-content" >
                @yield('content')
            </div>
            <!-- END MAIN CONTENT-->
        </div>
        <!-- END PAGE CONTAINER-->
    </div>
        <!-- END Page Wrapper-->
@include('layout.inc.footer')