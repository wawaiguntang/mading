<?php
$profile = getProfileWeb();
?>
<!-- Page Title -->
<div class="page-title-area">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="title-item">
                    <h2>Dokumen</h2>
                    <ul>
                        <li>
                            <a href="<?php echo base_url() ?>">Beranda</a>
                        </li>
                        <li>
                            <span>Dokumen</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    ul {
        margin-left: 20px;
    }

    .wtree li {
        list-style-type: none;
        margin: 10px 0 10px 10px;
        position: relative;
    }

    .wtree li:before {
        content: "";
        position: absolute;
        top: -10px;
        left: -20px;
        border-left: 1px solid #ddd;
        border-bottom: 1px solid #ddd;
        width: 20px;
        height: 15px;
    }

    .wtree li:after {
        position: absolute;
        content: "";
        top: 5px;
        left: -20px;
        border-left: 1px solid #ddd;
        border-top: 1px solid #ddd;
        width: 20px;
        height: 100%;
    }

    .wtree li:last-child:after {
        display: none;
    }

    .wtree li a {
        display: block;
        border: 1px solid #ddd;
        padding: 10px;
        color: #888;
        text-decoration: none;
    }

    .wtree li a:hover,
    .wtree li a:focus {
        background: #eee;
        color: #000;
        border: 1px solid #aaa;
    }

    .wtree li a:hover+ul li a,
    .wtree li a:focus+ul li a {
        background: #eee;
        color: #000;
        border: 1px solid #aaa;
    }

    .wtree li a:hover+ul li:after,
    .wtree li a:hover+ul li:before,
    .wtree li a:focus+ul li:after,
    .wtree li a:focus+ul li:before {
        border-color: #aaa;
    }
</style>    
<div class="rules-area ptb-100">
    <div class="container">
        <h1 class="title">Dokumen</h1>
        <p><?php echo $profile['document'] ?></p>
        <ul class="wtree">
            <?php

            echo $document;
            ?>

        </ul>
    </div>
</div>