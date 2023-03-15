<!-- Page Title -->
<div class="page-title-area">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="title-item">
                    <h2>Kontak</h2>
                    <ul>
                        <li>
                            <a href="<?php echo base_url() ?>">Beranda</a>
                        </li>
                        <li>
                            <span>Kontak</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact -->
<div class="contact-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-12 col-12">
                <h5 class="text-center">KONTAK</h5>
                <ul>
                    <li>
                        <span>Nama:</span>
                        <?php echo $contact['nama'] ?>
                    </li>
                    <li>
                        <span>No Hp:</span>
                        <?php echo $contact['noHp'] ?>
                    </li>
                    <li>
                        <span>Email:</span>
                        <a href="mailto:<?php echo $contact['email'] ?>"><?php echo $contact['email'] ?></a>
                    </li>
                </ul>
                <div class="copyright-area">
                    <div class="copyright-item">
                        <ul>
                            <li>
                                <a href="<?php echo $contact['mediaSosial']['fb'] ?>" target="_blank">
                                    <i class='bx bxl-facebook'></i>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo $contact['mediaSosial']['tw'] ?>" target="_blank">
                                    <i class='bx bxl-twitter'></i>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo $contact['mediaSosial']['ig'] ?>" target="_blank">
                                    <i class='bx bxl-instagram'></i>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo $contact['mediaSosial']['yt'] ?>" target="_blank">
                                    <i class='bx bxl-youtube'></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <hr>
                <div class="row mt-4">
                    <div class="col-md-12 col-sm-12 col-12">
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
                </div>
            </div>
            <div class="col-md-6 col-sm-12 col-12 ">
                <h5 class="text-center">ALAMAT</h5>
                <p class=""><?php echo $contact['alamat'] ?></p>
                <style>
                    .map-responsive{

                        overflow:hidden;
                    
                        padding-bottom:56.25%;
                    
                        position:relative;
                    
                        height:0;
                    
                    }
                    
                    .map-responsive iframe{
                    
                        left:0;
                    
                        top:0;
                    
                        height:100%;
                    
                        width:100%;
                    
                        position:absolute;
                    
                    }
                </style>
                <div class="map-responsive">
                    <iframe src="<?php echo $contact['map'] ?>" height="450" class="rounded-3 " style="border:0;" allowfullscreen="true" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
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
                    if(formId == 'form'){
                        $("#exampleModal").modal("hide");
                    }else{
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
<!-- End Contact -->