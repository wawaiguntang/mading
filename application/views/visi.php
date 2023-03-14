<!-- Page Title -->
<div class="page-title-area">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="title-item">
                    <h2>Visi dan Misi</h2>
                    <ul>
                        <li>
                            <a href="<?php echo base_url() ?>">Beranda</a>
                        </li>
                        <li>
                            <span>Visi dan Misi</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Design -->
<section class="design-area two pt-100 pb-70">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="design-content">
                    <div class="section-title two">
                        <span class="sub-title">VISI</span>
                        <h2><?php echo $visi['title'] ?></h2>
                    </div>
                    <?php echo $visi['description'] ?>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="design-img">
                    <img src="<?php echo base_url('assets/front/img/visi/' . $visi['image']) ?>" alt="Design">
                </div>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="design-img">
                    <img src="<?php echo base_url('assets/front/img/visi/' . $misi['image']) ?>" alt="Design">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="design-content">
                    <div class="section-title two">
                        <span class="sub-title">MISI</span>
                        <h2><?php echo $misi['title'] ?></h2>
                    </div>
                    <?php echo $misi['description'] ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Design -->