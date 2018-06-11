        <!-- Jquery JS-->
        <script src="{{ asset('vendor/jquery-3.2.1.min.js') }}"></script>
        <script src="{{ asset('vendor/jquery-ui.min.js') }}"></script>
        
        <!-- Bootstrap JS-->
        <script src="{{ asset('vendor/bootstrap-4.1/popper.min.js') }}"></script>
        <script src="{{ asset('vendor/bootstrap-4.1/bootstrap.min.js') }}"></script>
        <!-- Vendor JS       -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/additional-methods.min.js"></script>
        <script src="{{ asset('vendor/slick/slick.min.js') }}"></script>
        <script src="{{ asset('vendor/wow/wow.min.js') }}"></script>
        <script src="{{ asset('vendor/animsition/animsition.min.js') }}"></script>
        <script src="{{ asset('vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }}">
        </script>
        <script src="{{ asset('vendor/counter-up/jquery.waypoints.min.js') }}"></script>
        <script src="{{ asset('vendor/counter-up/jquery.counterup.min.js') }}"></script>
        <script src="{{ asset('vendor/circle-progress/circle-progress.min.js') }}"></script>
        <script src="{{ asset('vendor/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
        <script src="{{ asset('vendor/chartjs/Chart.bundle.min.js') }}"></script>
        <script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/moment@2.22.2/min/moment.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <!-- Main JS-->
        <script src="{{ asset('js/main.js') }}"></script>
        <script type="text/javascript">
            $(function () {
                $('#birthdate, #date_flow_data').datetimepicker({
                    format: 'YYYY-MM-DD'
                });
            });
        </script>
        
        <!-- Custom JS-->
        @yield('js')

    </body>

</html>
<!-- end document-->