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
                            <a href="<?php echo base_url('dokumen') ?>">Dokumen</a>
                        </li>
                        <li>
                            <span><?php echo $name ?></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    #canvases canvas {
        margin: 20px auto;
        display: block;
    }
</style>
<div class="rules-area ptb-100">
    <div class="container">
        <h3 class="text-center"><?php echo $name ?></h3>
        <div class="pagination-area">
            <ul>
                <li>
                    <a href="<?php echo base_url('assets/front/pdf/' . $dokumen['file']) ?>" download>Download</a>
                </li>
            </ul>
        </div>
        <div id="canvases" class="img-fluid"></div>
    </div>
</div>
<script>
    var url = '<?php echo base_url('assets/front/pdf/' . $dokumen['file']) ?>';
    var pdfDoc = null,
        pageNum = 1,
        pageRendering = false,
        pageNumPending = null,
        scale = 1;

    function renderPage(num, canvas) {
        var ctx = canvas.getContext('2d');
        pageRendering = true;
        // Using promise to fetch the page
        pdfDoc.getPage(num).then(function(page) {
            var viewport = page.getViewport({
                scale: scale
            });
            canvas.height = viewport.height;
            canvas.width = viewport.width;

            // Render PDF page into canvas context
            var renderContext = {
                canvasContext: ctx,
                viewport: viewport
            };
            var renderTask = page.render(renderContext);

            // Wait for rendering to finish
            renderTask.promise.then(function() {
                pageRendering = false;
                if (pageNumPending !== null) {
                    // New page rendering is pending
                    renderPage(pageNumPending);
                    pageNumPending = null;
                }
            });
        });
    }

    pdfjsLib.getDocument(url).promise.then(function(pdfDoc_) {
        pdfDoc = pdfDoc_;

        const pages = parseInt(pdfDoc.numPages);

        var canvasHtml = '';
        for (var i = 0; i < pages; i++) {
            canvasHtml += '<canvas id="canvas_' + i + '" class="img-fluid"></canvas>';
        }

        document.getElementById('canvases').innerHTML = canvasHtml;

        for (var i = 0; i < pages; i++) {
            var canvas = document.getElementById('canvas_' + i);
            renderPage(i + 1, canvas);
        }
    });
</script>