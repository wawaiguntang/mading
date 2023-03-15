<?php
$profile = getProfileWeb();
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/front/css/bootstrap.min.css">
    <!-- Meanmenu CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/front/css/meanmenu.css">
    <!-- Boxicons CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/front/css/boxicons.min.css">
    <!-- Flaticons CSC -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/front/fonts/flaticon.css">
    <!-- Popup CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/front/css/magnific-popup.min.css">
    <!-- Odometer CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/front/css/odometer.min.css">
    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/front/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/front/css/owl.theme.default.min.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/front/css/animate.min.css">
    <!-- Style CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/front/css/style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/front/css/responsive.css">
    <!-- Theme Dark CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/front/css/theme-dark.css">

    <title><?php echo $profile['title'] ?></title>

    <link rel="icon" type="image/png" href="<?php echo base_url($profile['icon']) ?>">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/orgchart/2.1.3/css/jquery.orgchart.min.css">

    <script src="<?php echo base_url() ?>assets/front/js/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/orgchart/2.1.3/js/jquery.orgchart.min.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.2.2/pdf.min.js"></script>
</head>

<body>

    <!-- Preloader -->
    <div class="loader">
        <div class="d-table">
            <div class="d-table-cell">
                <div class="spinner">
                    <div class="rect1"></div>
                    <div class="rect2"></div>
                    <div class="rect3"></div>
                    <div class="rect4"></div>
                    <div class="rect5"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Preloader -->

    <!-- Start Navbar Area -->
    <div class="navbar-area fixed-top">
        <!-- Menu For Mobile Device -->
        <div class="mobile-nav">
            <a href="<?php echo base_url() ?>" class="logo">
                <img src="<?php echo base_url($profile['icon']) ?>" alt="Logo" style="max-height: 40px !important;">
            </a>
        </div>

        <!-- Menu For Desktop Device -->
        <div class="main-nav <?php echo (($this->uri->segment(1) == 'beranda' || $this->uri->segment(1) == '') ? '' : 'two') ?>">
            <div class="container-fluid">
                <nav class="navbar navbar-expand-md navbar-light">
                    <a class="navbar-brand" href="<?php echo base_url() ?>">
                        <img src="<?php echo base_url('assets/front/img/' . (($this->uri->segment(1) == 'beranda' || $this->uri->segment(1) == '') ? 'logo-one.png' : 'logo-two.png')) ?>" alt="Logo" style="max-height: 50px !important;">
                    </a>
                    <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a href="<?php echo base_url('beranda') ?>" class="nav-link">Beranda</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link dropdown-toggle">Bagian Informasi <i class='bx bx-chevron-down'></i></a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('display/lobby') ?>" class="nav-link">Lobby</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('display/masjid') ?>" class="nav-link">Masjid</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo base_url('berita-dan-kegiatan') ?>" class="nav-link">Berita dan Kegiatan</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo base_url('perpustakaan') ?>" class="nav-link">Perpustakaan</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo base_url('kontak') ?>" class="nav-link">Kontak</a>
                            </li>
                        </ul>
                        <div class="side-nav">
                            <?php
                            $user = $this->session->userdata('userCode');
                            if ($user == NULL) :
                            ?>
                                <a class="left-btn" href="<?php echo base_url('auth/index') ?>">
                                    <i class='bx bx-log-out'></i>
                                    Masuk
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- End Navbar Area -->
    <?php
    if (!isset($_view)) {
        echo "Content not set";
    } else {
        $this->load->view($_view);
    }
    ?>


    <!-- Footer -->
    <footer class="pt-100 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-lg-4">
                    <div class="footer-item">
                        <div class="footer-logo">
                            <a href="<?php echo base_url() ?>">
                                <img src="<?php echo base_url($profile['icon']) ?>" alt="Logo" style="max-height: 50px !important;">
                            </a>
                            <?php $visitor = getVisitor(); ?>
                            <h3>Statistik Pengunjung</h3>
                            <table id="foot-table-list">
                                <tr>
                                    <td class="text-white">Pengunjung Hari ini</td>
                                    <td class="text-white">&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                                    <td class="text-white"><?php echo $visitor['pengunjunghariini'] ?> orang</td>
                                </tr>

                                <tr>
                                    <td class="text-white">Total Pengunjung</td>
                                    <td class="text-white">&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                                    <td class="text-white"><?php echo $visitor['totalpengunjung'] ?> orang</td>
                                </tr>

                                <tr>
                                    <td class="text-white">Pengunjung Online</td>
                                    <td class="text-white">&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                                    <td class="text-white"><?php echo $visitor['pengunjungonline'] ?> orang</td>
                                </tr>

                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="footer-item">
                        <div class="footer-links">
                            <h3>Halaman</h3>
                            <ul>
                                <li>
                                    <a href="<?php echo base_url('berita-dan-kegiatan') ?>" target="_blank">Berita dan kegiatan</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('perpustakaan') ?>" target="_blank">Perpustakaan</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('display/lobby') ?>" target="_blank">Bagian Informasi Lobby</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('') ?>" target="_blank">Bagian Informasi Masjid</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="footer-item">
                        <div class="footer-address">
                            <h3>Kontak</h3>
                            <ul>
                                <li>
                                    <span>Alamat:</span>
                                    <?php echo $profile['contact']['alamat'] ?>
                                </li>
                                <li>
                                    <span>Email:</span>
                                    <a href="mailto:<?php echo $profile['contact']['email'] ?>"><?php echo $profile['contact']['email'] ?></a>
                                </li>
                                <li>
                                    <span>Phone:</span>
                                    <?php echo $profile['contact']['noHp'] ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer -->

    <!-- Go Top -->
    <div class="go-top">
        <i class='bx bx-up-arrow'></i>
        <i class='bx bx-up-arrow'></i>
    </div>
    <!-- End Go Top -->

    <!-- sweetalert -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>

    <script>
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
    </script>
    <!-- Essential JS -->

    <script src="<?php echo base_url() ?>assets/front/js/bootstrap.bundle.min.js"></script>
    <!-- Form Validator JS -->
    <script src="<?php echo base_url() ?>assets/front/js/form-validator.min.js"></script>
    <!-- Contact JS -->
    <script src="<?php echo base_url() ?>assets/front/js/contact-form-script.js"></script>
    <!-- Ajax Chip JS -->
    <script src="<?php echo base_url() ?>assets/front/js/jquery.ajaxchimp.min.js"></script>
    <!-- Meanmenu JS -->
    <script src="<?php echo base_url() ?>assets/front/js/jquery.meanmenu.js"></script>
    <!-- Popup JS -->
    <script src="<?php echo base_url() ?>assets/front/js/jquery.magnific-popup.min.js"></script>
    <!-- Odometer JS -->
    <script src="<?php echo base_url() ?>assets/front/js/odometer.min.js"></script>
    <script src="<?php echo base_url() ?>assets/front/js/jquery.appear.js"></script>
    <!-- Owl Carousel JS -->
    <script src="<?php echo base_url() ?>assets/front/js/owl.carousel.min.js"></script>
    <!-- Thumb Slider JS -->
    <script src="<?php echo base_url() ?>assets/front/js/thumb-slide.js"></script>
    <!-- Wow JS -->
    <script src="<?php echo base_url() ?>assets/front/js/wow.min.js"></script>
    <!-- Custom JS -->
    <script src="<?php echo base_url() ?>assets/front/js/custom.js"></script>
</body>

</html>