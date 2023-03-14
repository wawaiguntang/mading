<div class="row">
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-body  px-4 pt-2 pb-2">
                <?php echo form_open('', ["id" => "form"]); ?>
                <?php echo inputWithFormGroup('Nama', 'text', 'nama', 'Nama', [], ["value" => $contact['nama']]); ?>
                <?php echo inputWithFormGroup('No HP', 'text', 'noHp', 'No HP', [], ["value" => $contact['noHp']]); ?>
                <?php echo inputWithFormGroup('Email', 'text', 'email', 'Email', [], ["value" => $contact['email']]); ?>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="3"><?php echo $contact['alamat'] ?></textarea>
                </div>
                <div class="form-group">
                    <label for="map">Map</label>
                    <textarea class="form-control" id="map" name="map" rows="3"><?php echo $contact['map'] ?></textarea>
                </div>
                <?php echo inputWithFormGroup('Facebook', 'text', 'fb', 'Facebook', [], ["value" => $contact['mediaSosial']['fb']]); ?>
                <?php echo inputWithFormGroup('Twitter', 'text', 'tw', 'Twitter', [], ["value" => $contact['mediaSosial']['tw']]); ?>
                <?php echo inputWithFormGroup('Youtube', 'text', 'yt', 'Youtube', [], ["value" => $contact['mediaSosial']['yt']]); ?>
                <?php echo inputWithFormGroup('Instagram', 'text', 'ig', 'Instagram', [], ["value" => $contact['mediaSosial']['ig']]); ?>


                <div class="d-flex justify-content-end">
                    <?php echo button('Save', ["btn-primary"], ["id" => "btnSave", "onclick" => "saveDataFF('" . base_url('contact/action/index/update') . "')"]); ?>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<script>
    function saveDataFF(url, btnId = "btnSave", formId = "form") {
        $(`#${btnId}`).text("Saving...");
        $(`#${btnId}`).attr("disabled", true);
        $.ajax({
            url: url,
            type: "POST",
            data: $(`#${formId}`).serialize(),
            dataType: "json",
            success: function(data) {
                if (data.status) {
                    loadPage("<?php echo base_url('contact/index') ?>", true);
                    handleToast("success", data.message);
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