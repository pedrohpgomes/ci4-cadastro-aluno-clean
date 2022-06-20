</div>
<!-- ./wrapper -->

   
    <!-- Bootstrap 4 -->
    <script src="<?=base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
    <!-- ChartJS -->
    <!-- <script src="plugins/chart.js/Chart.min.js"></script> -->
    <!-- Sparkline -->
    <!-- <script src="plugins/sparklines/sparkline.js"></script> -->

    <!-- jQuery Knob Chart -->
    <!-- <script src="plugins/jquery-knob/jquery.knob.min.js"></script> -->
    <!-- daterangepicker -->
    <!-- <script src="plugins/moment/moment.min.js"></script> -->
    <!-- <script src="plugins/daterangepicker/daterangepicker.js"></script> -->
    <!-- Tempusdominus Bootstrap 4 -->
    <!-- <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script> -->
    <!-- Summernote -->
    <!-- <script src="plugins/summernote/summernote-bs4.min.js"></script> -->
    <!-- overlayScrollbars -->
    <script src="<?=base_url('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')?>"></script>
    <!-- AdminLTE App -->
    <script src="<?=base_url('assets/dist/js/adminlte.js')?>"></script>

    <script>
        let buttonDarkMode = document.getElementById('dark-icon');
        var darkEnv = "desafio-delta-darkmode";
        var body = document.getElementsByTagName('body')[0];

        buttonDarkMode.addEventListener('click', function() {
            verificaTemaOnClick(this);
        });        
    
        function verificaTemaOnClick(element){
            if (element.classList.contains('fa-moon')) {//tema escuro - darkmode = false
                element.classList.remove('fa-moon');
                element.classList.add('fa-sun');
                localStorage.setItem(darkEnv, JSON.stringify(true));
            } else if (element.classList.contains('fa-sun')) {//tema claro - darkmode = true
                element.classList.remove('fa-sun');
                element.classList.add('fa-moon');
                localStorage.setItem(darkEnv, JSON.stringify(false));
            }
            body.classList.toggle("dark-mode");
        }

        function loadDark(){
            let dark = JSON.parse(localStorage.getItem(darkEnv));
            let darkIcon = document.getElementById('dark-icon');
            if (dark === true) {
                body.classList.add("dark-mode");
                darkIcon.classList.remove('fa-moon');
                darkIcon.classList.add('fa-sun');
            } else if (dark === null) {
                localStorage.setItem(darkEnv, JSON.stringify(false));
            }
        }
        $(window).on("load",loadDark());
    </script>

</body>
</html>
