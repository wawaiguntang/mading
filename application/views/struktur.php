<?php
$profile = getProfileWeb();
?>
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
<style>
    #chart-container {
        font-family: Arial;
        height: auto;
        width: auto;
        /* border: 2px dashed #aaa; */
        border-radius: 5px;
        overflow: auto;
        text-align: center;
    }

    .orgchart {
        background: #fff;
    }

    .orgchart td.left,
    .orgchart td.right,
    .orgchart td.top {
        border-color: #aaa;
    }

    .orgchart td>.down {
        background-color: #aaa;
    }

    .orgchart .middle-level .title {
        background-color: #006699;
    }

    .orgchart .middle-level .content {
        border-color: #006699;
    }

    .orgchart .product-dept .title {
        background-color: #009933;
    }

    .orgchart .product-dept .content {
        border-color: #009933;
    }

    .orgchart .rd-dept .title {
        background-color: #993366;
    }

    .orgchart .rd-dept .content {
        border-color: #993366;
    }

    .orgchart .pipeline1 .title {
        background-color: #996633;
    }

    .orgchart .pipeline1 .content {
        border-color: #996633;
    }

    .orgchart .frontend1 .title {
        background-color: #cc0066;
    }

    .orgchart .frontend1 .content {
        border-color: #cc0066;
    }

    #github-link {
        position: fixed;
        top: 0px;
        right: 10px;
        font-size: 3em;
    }
</style>
<div class="rules-area pt-100">
    <div class="container">
        <h1 class="title">Struktur Organisasi</h1>
        <p><?php echo $profile['structure'] ?></p>
    </div>
</div>
<div id="chart-container" class="mb-4"></div>
<script>
    "use strict";

    (function($) {
        $(function() {
            var oc = $("#chart-container").orgchart({
                data: '<?php echo base_url('struktur/listData') ?>',
                nodeContent: "title"
            });
        });
    })(jQuery);
</script>