@include('includes.head')

@include('includes.navbar')

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

       @include('includes.sidebar')

        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">

            @yield('content')

          @include('includes.footer')
        </div>
        <!--  END CONTENT AREA  -->
    </div>
    <!-- END MAIN CONTAINER -->

    @include('includes.scripts')

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
   @yield('pageScripts')
    <!-- END PAGE LEVEL SCRIPTS -->
</body>

<!-- Mirrored from designreset.com/cork/ltr/demo4/form_bootstrap_select.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 04 Aug 2021 16:46:49 GMT -->
</html>
