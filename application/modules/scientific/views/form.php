<div class="row loading">
    <div class="col-md-8 offset-md-2">
        <div class="card mb-4">
            <div class="card-body  px-4 pt-2 pb-2">
                <div class="row mb-3">
                    <div class="d-flex justify-content-between mt-2 py-auto">
                        <i title="back" role="button" class="ri-arrow-left-circle-line ri-lg my-auto text-danger" onclick="backPrevious()"></i>
                        <p class="pl-4 my-auto fw-bolder"> <?php echo $title ?></p>
                    </div>
                </div>
                <?php echo form_open_multipart('', ["id" => "form"]); ?>
                <?php echo input('hidden', 'scientificCode', '', [], ["value" => $scientificCode]); ?>
                <?php echo inputWithFormGroup('Nama', 'text', 'name', 'Nama', [], ["value" => $name]); ?>
                <?php echo inputWithFormGroup('Gambar', 'file', 'image', 'Gambar', []); ?>
                <div class="form-group">
                    <label for="description">Deskripsi</label>
                    <textarea class="form-control" id="description" name="description" rows="3"><?php echo $description ?></textarea>
                </div>
                <div class="d-flex justify-content-end">
                    <?php echo button('Cancel', ["btn-warning me-2"], ["id" => "btnCancel", "onclick" => "backPrevious()"]); ?>
                    <?php echo button('Save', ["btn-primary"], ["id" => "btnSave", "onclick" => "saveDataD()"]); ?>
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
        <?php if ($scientificCode) : ?>
            url = base_url + 'scientific/action/index/update/' + <?php echo $scientificCode ?>;
        <?php else : ?>
            url = base_url + 'scientific/action/index/add';
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