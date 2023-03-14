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

    <!-- Sign Up -->
    <div class="user-form-area">
        <div class="container-fluid p-0">
            <div class="row m-0">
                <div class="col-lg-6 p-0">
                    <div class="user-img" style="background-image: url('../assets/front/img/a.png');">
                        <img src="<?php echo base_url('assets/front/img/a.png') ?>" alt="User">
                    </div>
                </div>
                <div class="col-lg-6 p-0">
                    <div class="user-content">
                        <div class="d-table">
                            <div class="d-table-cell">
                                <div class="user-content-inner">
                                    <div class="top">
                                        <a href="<?php echo base_url() ?>">
                                            <img src="<?php echo base_url($profile['icon']) ?>" alt="Logo" style="max-height: 50px !important;">
                                        </a>
                                        <h2>Masuk</h2>
                                    </div>
                                    <?php
                                    echo form_open(base_url('auth/act_login'), 'role="form text-left"');
                                    ?>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <input type="email" name="email" class="form-control" placeholder="Enter your email">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <input type="password" name="password" class="form-control" placeholder="Enter your password">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <button type="submit" class="btn">Masuk</button>
                                        </div>
                                    </div>
                                    <?php
                                    echo form_close();
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Sign Up -->


    <!-- Essential JS -->
    <script src="<?php echo base_url() ?>assets/front/js/jquery.min.js"></script>
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