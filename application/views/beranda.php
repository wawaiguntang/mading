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
<hr>
<!-- Application -->
<section class="application-area ptb-100">
    <div class="application-shape">
        <img src="assets/front/img/sass/application1.png" alt="Shape">
        <img src="assets/front/img/sass/application2.png" alt="Shape">
    </div>
    <div class="container-fluid p-0">
        <div class="row m-0 align-items-center">
            <div class="col-sm-6 col-lg-7">
                <div class="application-content">
                    <div class="section-title">
                        <span class="sub-title">Layanan</span>
                        <h2>Beberapa layanan</h2>
                    </div>
                    <ul>
                        <?php foreach ($service as $k => $v) : ?>
                            <li>
                                <i class="flaticon-checkmark"></i>
                                <?php echo $v['name'] ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <a href="<?php echo base_url('layanan') ?>" class="cmn-btn">
                        Selengkapnya
                        <i class='bx bx-plus'></i>
                    </a>
                </div>
            </div>
            <div class="col-sm-6 col-lg-5 pr-0">
                <div class="application-img">
                    <img src="<?php echo base_url('assets/front/img/home/' . $profile['beranda']['imageService']) ?>" alt="Application">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Application -->
<hr>
<!-- Service -->
<section class="service-area pb-70">
    <div class="container">
        <div class="section-title">
            <span class="sub-title">Kontak</span>
            <h2>Kontak kami</h2>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-12 col-12">
                <div class="service-item">
                    <i class="flaticon-chat"></i>
                    <h3>
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#exampleModal">Kritik, Saran dan Masukan</a>
                    </h3>
                    <p>Kritik, Saran dan Masukan dari anda sangat penting bagi kami</p>
                    <img class="img-one" src="<?php echo base_url() ?>assets/front/img/sass/service-shape.png" alt="Shape">
                    <img class="img-two" src="<?php echo base_url() ?>assets/front/img/sass/service-shape1.png" alt="Shape">
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Kritik, Saran dan Masukan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <?php echo form_open('', ["id" => "form"]); ?>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control" name="name" id="nama" placeholder="Masukan Nama">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Masukan Email">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Tipe</label>
                                <select class="form-select" aria-label="Default select example" name="type">
                                    <option value="Kritik">Kritik</option>
                                    <option value="Saran">Saran</option>
                                    <option value="Masukan">Masukan</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="isi" class="form-label">Isi</label>
                                <textarea class="form-control" id="isi" name="content" rows="3"></textarea>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-sm btn-primary" id="btnSave" onclick="saveData('<?php echo base_url('kontak/sendSuggestion'); ?>')">Kirim</button>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-12 col-12">
                <div class="service-item">
                    <i class="flaticon-mail"></i>
                    <h3>
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#exampleModal2">Diskusi Hukum</a>
                    </h3>
                    <p>Mari berdiskusi dengan kami</p>
                    <img class="img-one" src="<?php echo base_url() ?>assets/front/img/sass/service-shape.png" alt="Shape">
                    <img class="img-two" src="<?php echo base_url() ?>assets/front/img/sass/service-shape1.png" alt="Shape">
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Diskusi Hukum</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <?php echo form_open('', ["id" => "form2"]); ?>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control" name="name" id="nama" placeholder="Masukan Nama">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Masukan Email">
                            </div>
                            <div class="mb-3 d-none">
                                <label for="" class="form-label">Tipe</label>
                                <select class="form-select" aria-label="Default select example" name="type">
                                    <option value="Kritik">Kritik</option>
                                    <option value="Saran">Saran</option>
                                    <option value="Masukan">Masukan</option>
                                    <option value="Diskusi Hukum" selected>Diskusi Hukum</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="isi" class="form-label">Isi</label>
                                <textarea class="form-control" id="isi" name="content" rows="3"></textarea>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-sm btn-primary" id="btnSave2" onclick="saveData('<?php echo base_url('kontak/sendSuggestion'); ?>','btnSave2','form2')">Kirim</button>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Service -->

<script>
    function saveData(url, btnId = "btnSave", formId = "form") {
        $(`#${btnId}`).text("Saving...");
        $(`#${btnId}`).attr("disabled", true);
        $.ajax({
            url: url,
            type: "POST",
            data: $(`#${formId}`).serialize(),
            dataType: "json",
            success: function(data) {
                if (data.status) {
                    handleToast("success", data.message);
                    if (formId == 'form') {
                        $("#exampleModal").modal("hide");
                    } else {
                        $("#exampleModal2").modal("hide");
                    }
                } else {
                    handleError(data);
                }
                $(`#${btnId}`).text("Save");
                $(`#${btnId}`).attr("disabled", false);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Error adding  data");
                $(`#${btnId}`).text("Save");
                $(`#${btnId}`).attr("disabled", false);
            },
        });

        $("#form input, #form textarea").on("keyup", function() {
            $(this).removeClass("is-valid is-invalid");
        });
        $("#form select").on("change", function() {
            $(this).removeClass("is-valid is-invalid");
        });
    }
</script>