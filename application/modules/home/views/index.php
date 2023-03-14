<div class="row">
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-body  px-4 pt-2 pb-2">
                <?php echo form_open('', ["id" => "form"]); ?>
                <?php echo inputWithFormGroup('Title', 'text', 'title', 'Title', [], ["value" => $beranda['title']]); ?>
                <?php echo inputWithFormGroup('Image', 'file', 'image', 'Image', []); ?>
                <?php echo inputWithFormGroup('Image Service', 'file', 'imageService', 'Image Service', []); ?>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3"><?php echo $beranda['description'] ?></textarea>
                </div>

                <div class="d-flex justify-content-end">
                    <?php echo button('Save', ["btn-primary"], ["id" => "btnSave", "onclick" => "save()"]); ?>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#description').summernote({
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
        });

        $('.dropdown-toggle').dropdown()

        function uploadImage(image) {
            var data = new FormData();
            data.append("image", image);
            $.ajax({
                url: "<?php echo site_url('home/action/index/upload_image') ?>",
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
                url: "<?php echo site_url('home/action/index/delete_image') ?>",
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


        url = base_url + 'home/action/index/update';

        var formData = new FormData($("#form")[0]);
        formData.append("description", $('#description').summernote('code'));

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