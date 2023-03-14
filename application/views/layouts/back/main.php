<?php
$profile = getProfileWeb();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url() ?>assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="<?php echo base_url($profile['icon']) ?>">
    <title>
        <?php echo $profile['title'] ?>
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="<?php echo base_url() ?>assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <link href="<?php echo base_url() ?>assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="<?php echo base_url() ?>assets/css/soft-ui-dashboard.css?v=1.0.3" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-avatar@1.0.3/dist/avatar.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.css" integrity="sha512-ngQ4IGzHQ3s/Hh8kMyG4FC74wzitukRMIcTOoKT3EyzFZCILOPF0twiXOQn75eDINUfKBYmzYn2AA8DkAk8veQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" integrity="sha512-6PM0qYu5KExuNcKt5bURAoT6KCThUmHRewN3zUFNaoI6Di7XJPTMoT6K0nsagZKk2OB4L7E3q1uQKHNHd4stIQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- datatables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

    <!-- remixicon -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

    <!-- scroll -->
    <style>
        body {
            height: 100%;
            overflow-y: scroll;
        }


        body.modal-open {
            overflow: hidden;
        }

        ::-webkit-scrollbar {
            width: 20px;
        }

        ::-webkit-scrollbar-track {
            background-color: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background-color: #d6dee1;
            border-radius: 20px;
            border: 6px solid transparent;
            background-clip: content-box;
        }

        ::-webkit-scrollbar-thumb:hover {
            background-color: #a8bbbf;
        }

        .loading-skeleton h1,
        .loading-skeleton h2,
        .loading-skeleton h3,
        .loading-skeleton h4,
        .loading-skeleton h5,
        .loading-skeleton h6,
        .loading-skeleton p,
        .loading-skeleton li,
        .loading-skeleton select,
        .loading-skeleton table,
        .loading-skeleton tr,
        .loading-skeleton .form-select,
        .loading-skeleton .select2,
        .loading-skeleton .select2-selection__rendered,
        .loading-skeleton .btn,
        .loading-skeleton label,
        .loading-skeleton .form-control {
            color: transparent;
            appearance: none;
            -webkit-appearance: none;
            background-color: #eee;
            border-color: #eee;
        }

        .loading-skeleton h1::placeholder,
        .loading-skeleton h2::placeholder,
        .loading-skeleton h3::placeholder,
        .loading-skeleton h4::placeholder,
        .loading-skeleton h5::placeholder,
        .loading-skeleton h6::placeholder,
        .loading-skeleton p::placeholder,
        .loading-skeleton li::placeholder,
        .loading-skeleton .btn::placeholder,
        .loading-skeleton label::placeholder,
        .loading-skeleton .form-control::placeholder {
            color: transparent;
        }

        @keyframes loading-skeleton {
            from {
                opacity: 0.4;
            }

            to {
                opacity: 1;
            }
        }

        .loading-skeleton {
            pointer-events: none;
            animation: loading-skeleton 1s infinite alternate;
        }

        .loading-skeleton img {
            filter: grayscale(100) contrast(0%) brightness(1.8);
        }
    </style>

    <!-- sweetalert -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>

    <!-- select -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.2.0/dist/select2-bootstrap-5-theme.min.css" />

    <!-- iconpicker -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/js/bootstrap-iconpicker/css/bootstrap-iconpicker.min.css">
    <script type="text/javascript" src="<?php echo base_url() ?>assets/js/bootstrap-iconpicker/js/iconset/fontawesome5-3-1.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>assets/js/bootstrap-iconpicker/js/bootstrap-iconpicker.min.js"></script>


    <script>
        var base_url = '<?php echo base_url() ?>';

        let histori = '';
        // custom

        $('body').on('input', '.rupiah', function() {
            this.value = formatRupiah(this.value, 'Rp. ')
        })

        function handleToast(icon, title) {
            var toastMixin = Swal.mixin({
                toast: true,
                icon: icon,
                title: title,
                animation: true,
                position: 'top-right',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });
            toastMixin.fire();
        }

        function breadcrumb(breadcrumb) {
            $("#breadcrumb").html(breadcrumb);
        }

        function toTop() {
            $('main').animate({
                scrollTop: 0
            }, 'fast');
        }

        function loadingOn() {
            $(".loading").addClass("loading-skeleton");
        }

        function loadingOff() {
            setTimeout(function() {
                $(".loading").removeClass("loading-skeleton");
            }, 1000)
        }
    </script>
    <script src="<?php echo base_url() ?>assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/router.js"></script>
    <script src="<?php echo base_url() ?>assets/js/plugins/chartjs.min.js"></script>

    <!-- select2 -->
    <style>
        .select2-dropdown {
            border-top-right-radius: 0px;
            border-top-left-radius: 0px;
            border-bottom-right-radius: 0.5rem;
            border-bottom-left-radius: 0.5rem;
            border: 1px solid #d2d6da;
        }

        .select2-search__field {
            border: 1px solid #d2d6da;
            border-radius: 0.5rem;
        }

        .select2-container {
            padding: 0.35rem 0.075rem;
            margin: 0px;
        }

        .select2-selection {
            padding: 0px;
            margin: 0px;
            border: 0px !important;
        }

        .select2-selection__arrow {
            display: none;
        }

        
    </style>
</head>

<body class="g-sidenav-show  bg-gray-100 g-sidenav-hidden">
    <!-- Side -->
    <?php $this->load->view('layouts/back/side'); ?>
    <main class="main-content position-relative mt-1 border-radius-lg ">
        <!-- Navbar -->
        <?php $this->load->view('layouts/back/nav'); ?>
        <div id="container" class="container-fluid py-4">
            <div id="konten" class="row">

                <!-- content -->
                <?php
                if (!isset($_view)) {
                    echo "Content not set";
                } else {
                    $this->load->view($_view);
                }
                ?>
            </div>
            <footer class="footer pt-3  ">
                <div class="container-fluid">
                    <div class="row align-items-center justify-content-lg-between">
                        <div class="col-lg-12 mb-lg-0 mb-4">
                            <div class="copyright text-center text-sm text-muted text-lg-start">
                                © <script>
                                    document.write(new Date().getFullYear())
                                </script>,
                                made with <i class="fa fa-heart"></i> by <a href="http://cosisma.com">Core Sistem Mediatama</a>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </main>
    <!--   Core JS Files   -->
    <script src="<?php echo base_url() ?>assets/js/core/popper.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/core/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/plugins/smooth-scrollbar.min.js"></script>

    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        console.log(document.querySelector('#sidenav-scrollbar'))
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
        $(".navbar-nav>li").each(function() {
            var navItem = $(this);
            if (navItem.children().hasClass('active')) {
                console.log(navItem.children())
                navItem.focus()
            }
        });
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="<?php echo base_url() ?>assets/js/soft-ui-dashboard.js?v=1.0.3"></script>
    <script src="<?= base_url() ?>assets/js/jquery-mask/jquery.mask.min.js"></script>
    <script src="<?= base_url() ?>assets/js/custom/rupiah.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.js" integrity="sha512-6F1RVfnxCprKJmfulcxxym1Dar5FsT/V2jiEUvABiaEiFWoQ8yHvqRM/Slf0qJKiwin6IDQucjXuolCfCKnaJQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        sidebarType("bg-white");
        // navbarFixed(true);
        // $('form').bind('keypress', false);

        function expandSidebar() {
            if ($('body').hasClass('g-sidenav-hidden')) {
                $('body').removeClass('g-sidenav-hidden')
                $('body').addClass('g-sidenav-pinned')
            } else {
                $('body').removeClass('g-sidenav-pinned')
                $('body').addClass('g-sidenav-hidden')
            }
        }
    </script>
</body>

</html>