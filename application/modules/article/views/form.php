<div class="row loading">
    <div class="col-md-8 offset-md-2">
        <div class="card mb-4">
            <div class="card-body  px-4 pt-2 pb-2">
                <div class="row mb-3">
                    <div class="d-flex justify-content-between mt-2 py-auto">
                        <i title="back" role="button" class="ri-arrow-left-circle-line ri-lg my-auto text-danger" onclick="backPrevious()"></i>
                        <p class="pl-4 my-auto fw-bolder"> <?php echo $titlePage ?></p>
                    </div>
                </div>
                <?php echo form_open_multipart('', ["id" => "form"]); ?>
                <?php echo input('hidden', 'articleCode', '', [], ["value" => $articleCode]); ?>
                <?php echo inputWithFormGroup('Title', 'text', 'title', 'Title', [], ["value" => $title]); ?>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <?php echo inputWithFormGroup('Thumbnail', 'file', 'image', 'Thumbnail', []); ?>
                    </div>
                    <div class="col-12 col-md-6">
                        <?php echo selectWithFormGroup('categoryCode', 'Category', 'categoryCode', $category, $categoryCode, []) ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="d-flex justify-content-between mb-1">
                        <label for="description">Tags</label>
                        <span class="badge bg-success" role="button" onclick="addForm()"><i class="fa fa-plus"></i></span>
                    </div>
                    <div class="d-flex flex-column" id="forTag">

                    </div>
                </div>
                <div class="form-group">
                    <label for="description">Content</label>
                    <textarea class="" name="content" id="content" rows="5"></textarea>
                </div>

                <div class="d-flex justify-content-end">
                    <?php echo button('Cancel', ["btn-warning me-2"], ["id" => "btnCancel", "onclick" => "backPrevious()"]); ?>
                    <?php echo button('Save', ["btn-primary"], ["id" => "btnSave", "onclick" => "save()"]); ?>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>

<script>
    loadingOn();
    $(document).ready(function() {
        loadingOff();
    });
</script>
<script>
    function saveDataD() {
        $("#btnSave").text("Saving...");
        $("#btnSave").attr("disabled", true);
        <?php if ($articleCode) : ?>
            url = base_url + 'article/action/index/update/' + <?php echo $articleCode ?>;
        <?php else : ?>
            url = base_url + 'article/action/index/add';
        <?php endif ?>
        var formData = new FormData($("#form")[0]);
        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            mimeType: "multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                var data = JSON.parse(data);
                if (data.status) {
                    backPrevious();
                    handleToast("success", data.message);
                } else {
                    handleError(data);
                }
                $("#btnSave").text("Save");
                $("#btnSave").attr("disabled", false);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Error adding / update data");
                $("#btnSave").text("Save");
                $("#btnSave").attr("disabled", false);
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

<script>
    function addForm(val = '') {
        $("#forTag").append(`
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Tag" name="tags[]" value="${val}">
                <span class="input-group-text" role="button" onclick="$(this).parent().remove()"><i class="fa fa-trash"></i></span>
            </div>
        `);
    }

    <?php if ($articleCode) : ?>
        <?php foreach ($tags as $k => $v) : ?>
            addForm('<?php echo $v['tag'] ?>');
        <?php endforeach; ?>
    <?php endif ?>

    $(document).ready(function() {
        $('#content').summernote({
            height: "300px",
            airMode: false,
            dialogsInBody: true,
            dialogsFade: true,
            disableDragAndDrop: false,
            toolbar: [
                // [groupName, [list of button]]
                ['para', ['style', 'ul', 'ol', 'paragraph']],
                ['fontsize', ['fontsize']],
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['height', ['height']],
                ['insert', ['picture', 'link']],
                ['color', ['color']],
                ['misc', ['undo', 'redo', 'print', 'help', 'fullscreen']]
            ],
            popover: {
                air: [
                    ['font', ['bold', 'underline', 'clear']]
                ]
            },
            callbacks: {
                onImageUpload: function(image) {
                    uploadImage(image[0]);
                },
                onMediaDelete: function(target) {
                    deleteImage(target[0].src);
                }
            }
        }).summernote('code', `<?php echo $content ?>`);
        $('.dropdown-toggle').dropdown()

        function uploadImage(image) {
            var data = new FormData();
            data.append("image", image);
            $.ajax({
                url: "<?php echo site_url('article/action/index/upload_image') ?>",
                cache: false,
                contentType: false,
                processData: false,
                data: data,
                type: "POST",
                success: function(url) {
                    $('#content').summernote("insertImage", url);
                },
                error: function(data) {
                    console.log(data);
                }
            });
        }

        function deleteImage(src) {
            $.ajax({
                data: {
                    src: src
                },
                type: "POST",
                url: "<?php echo site_url('article/action/index/delete_image') ?>",
                cache: false,
                success: function(response) {
                    console.log(response);
                }
            });
        }
    });

    function save() {
        $("#btnSave").text("menyimpan...");
        $("#btnSave").attr("disabled", true);
        var url, method;

        <?php if ($articleCode) : ?>
            url = base_url + 'article/action/index/update/' + <?php echo $articleCode ?>;
        <?php else : ?>
            url = base_url + 'article/action/index/add';
        <?php endif ?>

        var formData = new FormData($("#form")[0]);
        formData.append("content", $('#content').summernote('code'));

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            mimeType: "multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                var data = JSON.parse(data);
                if (data.status) {
                    backPrevious();
                    handleToast("success", data.message);
                } else {
                    handleError(data);
                }
                $("#btnSave").text("simpan");
                $("#btnSave").attr("disabled", false);

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Error adding / update data");
                $("#btnSave").text("simpan");
                $("#btnSave").attr("disabled", false);

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