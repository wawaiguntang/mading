<?php
$profile = getProfileWeb();
?>
<!-- Banner -->
<div class="banner-area">
    <div class="banner-shape">
        <img class="animate__animated animate__fadeInUp" src="<?php echo base_url('assets/front/img/home/' . $profile['beranda']['image']) ?>" alt="Banner">
        <img src="assets/front/img/sass/banner-shape1.png" alt="Banner">
        <img src="assets/front/img/sass/banner-shape2.png" alt="Banner">
        <img src="assets/front/img/sass/banner-shape3.png" alt="Banner">
        <img src="assets/front/img/sass/banner-shape2.png" alt="Banner">
        <img src="assets/front/img/sass/banner-shape3.png" alt="Banner">
    </div>
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container-fluid">
                <div class="banner-content">

                    <h1><?php echo $profile['beranda']['title'] ?></h1>
                    <?php echo $profile['beranda']['description'] ?>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Banner -->
<hr>
<!-- About -->
<section class="blog-area pb-100">
    <div class="container">
        <div class="section-title">
            <span class="sub-title">Artikel</span>
            <h2>Kegiatan Terbaru</h2>
        </div>
        <div class="row">
            <?php foreach ($kegiatan as $k => $v) : ?>
                <div class="col-sm-6 col-lg-4">
                    <div class="blog-item" style="background-image: url('assets/front/img/article/<?php echo $v['image'] ?>');">
                        <ul class="top">
                            <li><?php echo $v['created'] ?></li>
                            <li><?php echo $v['category'] ?></li>
                        </ul>
                        <h3>
                            <a href="<?php echo base_url('berita-dan-kegiatan/' . $v['slug']) ?>"><?php echo $v['title'] ?></a>
                        </h3>
                        <p><?php echo $v['content'] ?></p>
                        <ul class="bottom">
                            <li>
                                <img src="<?php echo base_url('assets/front/img/profile/' . $v['foto']) ?>" alt="Blog" style="max-width: 60px">
                            </li>
                            <li>
                                <span>by:</span>
                            </li>
                            <li>
                                <a href="#"><?php echo $v['name'] ?></a>
                            </li>
                        </ul>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="pagination-area">
            <ul>
                <li>
                    <a href="<?php echo base_url('berita-dan-kegiatan') ?>">Selengkapnya</a>
                </li>
            </ul>
        </div>
    </div>
</section>
<!-- End About -->
