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
<!-- Blog -->
<div class="blog-area ptb-100">
    <div class="container">
        <div class="d-flex justify-content-between mb-4 ">
            <div>
                <select class="form-select" name="categoryCode" aria-label="Kategori">
                    <option value="0">-- Semua --</option>
                    <option value="2">Kegiatan</option>
                    <option value="1">Berita</option>
                </select>
            </div>
            <div>
                <div class="input-group flex-nowrap">
                    <span class="input-group-text" id="addon-wrapping"><i class='bx bx-search'></i></span>
                    <input type="text" class="form-control" name="search" placeholder="Cari..." aria-label="Cari..." aria-describedby="addon-wrapping">
                </div>
            </div>
        </div>
        <div class="d-none loading text-center">Mencari Data ......</div>
        <div class="row" id="content">
        </div>

        <div class="pagination-area">
            <ul>
                <li>
                    <a href="javascript:void(0)" onclick="readMore()">Selengkapnya</a>
                </li>
            </ul>
        </div>

    </div>
</div>

<script>
    var page = 1
    var categoryCode = '0';
    var search = '';
    $(document).ready(function() {
        getList('0', '', 1);
    })

    $("select[name=categoryCode]").change(function() {
        categoryCode = $("select[name=categoryCode] option:selected").val();
        getList(categoryCode, search, 1)
    });

    $("input[name=search]").change(function() {
        search = $("input[name=search]").val();
        getList(categoryCode, search, 1)
    });

    function getList(categoryCode, search, page = 1, type = 'normal') {
        $(".loading").removeClass("d-none");
        $.ajax({
            url: '<?php echo base_url('berita/list') ?>',
            type: "POST",
            data: {
                categoryCode: categoryCode,
                search: search,
                page: page
            },
            success: function(data) {
                if (data.status) {
                    var html = '';
                    (data.data).forEach((i) => {
                        html += `
                        <div class="col-sm-6 col-lg-4">
                            <div class="blog-item" style="background-image: url('assets/front/img/article/${i.image}');">
                                <ul class="top">
                                    <li>${i.created}</li>
                                    <li>${i.category}</li>
                                </ul>
                                <h3>
                                    <a href="<?php echo base_url('berita-dan-kegiatan/') ?>${i.slug}">${i.title}</a>
                                </h3>
                                <p>${i.content}</p>
                                <ul class="bottom">
                                    <li>
                                        <img src="<?php echo base_url('assets/front/img/profile/') ?>${i.foto}" alt="Blog" style="max-width: 60px">
                                    </li>
                                    <li>
                                        <span>by:</span>
                                    </li>
                                    <li>
                                        <a href="#">${i.name}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        `;
                    });
                    if (html == '') {
                        html += '<div class="text-center">Data tidak ditemukan<div>'
                        $(".pagination-area").addClass("d-none");
                    } else {
                        $(".pagination-area").removeClass("d-none");
                    }

                    $(".loading").addClass("d-none");
                    if (type != 'normal') {
                        $("#content").append(html);
                    } else {
                        $("#content").html(html);
                    }
                } else {
                    handleError(data);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Error data");
            },
        });
    }


    function readMore() {
        getList(categoryCode, search, page + 1, 'sele')
    }
</script>
<!-- End Blog -->