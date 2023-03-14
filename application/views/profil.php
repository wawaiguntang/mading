<!-- Page Title -->
<div class="page-title-area">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="title-item">
                    <h2>Profil Pejabat Struktural</h2>
                    <ul>
                        <li>
                            <a href="<?php echo base_url() ?>">Beranda</a>
                        </li>
                        <li>
                            <span>Profil Pejabat Struktural</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Team -->
<section class="team-area-two ptb-100">
    <div class="container">
        <div class="row">

            <?php foreach ($profile as $k => $v) : ?>

                <div class="col-12 col-sm-12 col-md-4 col-lg-3">
                    <div class="team-item three">
                        <div class="top">
                            <img src="<?php echo base_url('assets/front/img/profile/' . $v['image']) ?>" alt="Team" style="max-height: 300px; object-fit: cover;">
                            <ul class="team-social">
                                <li>
                                    <a href="<?php echo $v['fb'] ?>" target="_blank">
                                        <i class='bx bxl-facebook'></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $v['tw'] ?>" target="_blank">
                                        <i class='bx bxl-twitter'></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $v['ig'] ?>" target="_blank">
                                        <i class='bx bxl-instagram-alt'></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $v['yt'] ?>" target="_blank">
                                        <i class='bx bxl-youtube'></i>
                                    </a>
                                </li>
                            </ul>
                            <div class="share-btn">
                                <span>
                                    <i class="bx bx-share-alt"></i>
                                </span>
                            </div>
                        </div>
                        <div class="bottom">
                            <h3><?php echo $v['name'] ?></h3>
                            <span><?php echo $v['title'] ?></span>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>
        </div>
    </div>
</section>
<!-- End Team -->