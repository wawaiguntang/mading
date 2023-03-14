<!-- Page Title -->
<div class="page-title-area">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="title-item">
                    <h2>Layanan</h2>
                    <ul>
                        <li>
                            <a href="<?php echo base_url() ?>">Beranda</a>
                        </li>
                        <li>
                            <span>Layanan</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Page Title -->
<section class="team-area-two ptb-100">
    <div class="container">
        <div class="row">

            <?php foreach ($service as $k => $v) : ?>
                <div class="col-sm-12 col-md-4 col-lg-3">
                    <div class="team-item three">
                        <div class="top">
                            <img src="<?php echo base_url('assets/front/img/service/' . $v['image']) ?>" alt="Team" style="height: 200px; object-fit: cover;">
                            <a class="share-btn" href="<?php echo $v['url'] ?>">
                                <span>
                                    <i class='bx bx-link-external'></i>
                                </span>
                            </a>
                        </div>
                        <div class="bottom">
                            <h3><?php echo $v['name'] ?></h3>
                            <span><?php echo $v['description'] ?></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>