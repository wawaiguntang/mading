<?php
$profile = getProfileWeb();
?>
<!-- Page Title -->
<div class="page-title-area">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="title-item">
                    <h2>Berita dan Kegiatan</h2>
                    <ul>
                        <li>
                            <a href="<?php echo base_url() ?>">Beranda</a>
                        </li>
                        <li>
                            <span>Berita dan Kegiatan</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Blog Details -->
<div class="blog-details-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="details-item">
                    <div class="details-img">
                        <?php
                        $unixtime = strtotime($article['created']);
                        ?>
                        <h4><?php echo date('d', $unixtime); ?> <span><?php echo date('M', $unixtime); ?></span></h4>
                        <img src="<?php echo base_url('assets/front/img/article/' . $article['image']) ?>" alt="Details">
                        <h2 class="mb-0 pb-0"><?php echo $article['title'] ?></h2>
                        <p class="m-0 p-0" style="font-size: 12px !important;"><?php echo tanggal_indo($article['created']) ?></p>
                    </div>
                    <?php echo $article['content'] ?>
                    <div class="details-tags">
                        <div class="row">
                            <div class="col-lg-7">
                                <div class="left">
                                    <ul>
                                        <li>
                                            <span>Tag:</span>
                                        </li>
                                        <?php foreach ($tag as $k => $v) : ?>
                                            <li>
                                                <a href="#">#<?php echo $v['tag'] ?></a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="right">
                                    <ul>
                                        <li>
                                            <a href="<?php echo $profile['contact']['mediaSosial']['fb'] ?>" target="_blank">
                                                <i class='bx bxl-facebook'></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo $profile['contact']['mediaSosial']['tw'] ?>" target="_blank">
                                                <i class='bx bxl-twitter'></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo $profile['contact']['mediaSosial']['ig'] ?>" target="_blank">
                                                <i class='bx bxl-instagram'></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo $profile['contact']['mediaSosial']['yt'] ?>" target="_blank">
                                                <i class='bx bxl-youtube'></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="details-user">
                        <img src="<?php echo base_url('assets/front/img/profile/' . $article['foto']) ?>" alt="Details">
                        <img src="<?php echo base_url() ?>assets/front/img/blog-details5.jpg" alt="Details">
                        <img src="<?php echo base_url() ?>assets/front/img/blog-details6.jpg" alt="Details">
                        <div class="top">
                            <div class="row align-items-end">
                                <div class="col-lg-6">
                                    <div class="top-left">
                                        <h3><?php echo $article['name'] ?></h3>
                                        <span>Author, Writer</span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="top-right">
                                        <ul>
                                            <li>
                                                <a href="<?php echo $article['fb'] ?>" target="_blank">
                                                    <i class='bx bxl-facebook'></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?php echo $article['tw'] ?>" target="_blank">
                                                    <i class='bx bxl-twitter'></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?php echo $article['ig'] ?>" target="_blank">
                                                    <i class='bx bxl-instagram'></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?php echo $article['yt'] ?>" target="_blank">
                                                    <i class='bx bxl-youtube'></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="widget-area">
                    <div class="recent widget-item">
                        <h3>Artikel Terkait</h3>
                        <?php foreach ($terkait as $k => $v) : ?>
                            <div class="recent-inner">
                                <ul class="align-items-center">
                                    <li>
                                        <img src="<?php echo base_url('assets/front/img/article/' . $v['image']) ?>" alt="Details">
                                    </li>
                                    <li>
                                        <span>January 12, 2020</span>
                                        <a href="<?php echo base_url('berita-dan-kegiatan/' . $v['slug']) ?>"><?php echo $v['title'] ?></a>
                                    </li>
                                </ul>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="cat widget-item">
                        <h3>Kategori</h3>
                        <ul>
                            <?php foreach ($category as $k => $v) : ?>
                                <li>
                                    <a href="#"><?php echo $v['category'] ?></a>
                                    <span>(<?php echo $v['total'] ?>)</span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="tags widget-item">
                        <h3>Tag</h3>
                        <ul>
                            <?php foreach ($tags as $k => $v) : ?>
                                <li>
                                    <a href="#">#<?php echo $v['tag'] ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Blog Details -->