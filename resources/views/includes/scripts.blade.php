    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('assets/js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/sweetalerts/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/sweetalerts/custom-sweetalert.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>

    <script>
        $(document).ready(function() {
            App.init();

            @if (session()->has('success'))
                swal({
                    title: 'Success!',
                    text: "{{ session('success') }}",
                    type: 'success',
                    padding: '2em'
                })
            @endif

           @if (session()->has('error'))
                swal({
                    title: 'Oops...',
                    text: "{{ session('error') }}",
                    type: 'error',
                    padding: '2em'
                })
           @endif

        });

    </script>

    <script src="{{ asset('assets/plugins/highlight/highlight.pack.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->
