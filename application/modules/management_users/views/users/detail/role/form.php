<div class="row loading">
    <div class="col-md-6 offset-md-3">
        <div class="card mb-4">
            <div class="card-body px-5 pt-2 pb-2">
                <div class="row mb-3">
                    <div class="d-flex justify-content-between mt-2 py-auto">
                        <i title="back" role="button" class="ri-arrow-left-circle-line ri-lg my-auto text-danger" onclick="backPrevious()"></i>
                        <p class="pl-4 my-auto fw-bolder"> <?php echo $title ?></p>
                    </div>
                </div>
                <?php echo form_open('', ["id" => "form"]); ?>
                <?php echo input('hidden', 'userCode', '', [], ["value" => $userCode]); ?>
                <?php echo selectWithFormGroup('roleCode', 'Role', 'roleCode', $roles, $roleCode, [], []); ?>
                <div class="d-flex justify-content-end">
                    <?php echo button('Save', ["btn-primary"], ["id" => "btnSaveRole", "onclick" => "saveRole(" . $userCode . ")"]); ?>
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
    function saveRole(id) {
        $("#btnSaveRole").text("Saving...");
        $("#btnSaveRole").attr("disabled", true);
        var url = base_url + 'management_users/action/users/addRole/' + id;

        $.ajax({
            url: url,
            type: "POST",
            data: $("#form").serialize(),
            dataType: "json",
            success: function(data) {
                if (data.status) {
                    backPrevious()
                    handleToast("success", data.message);
                } else {
                    handleError(data);
                }
                $("#btnSaveRole").text("Save");
                $("#btnSaveRole").attr("disabled", false);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Error adding  data");
                $("#btnSaveRole").text("Save");
                $("#btnSaveRole").attr("disabled", false);
            },
        });

        $("#form input, #form textarea").on("keyup", function() {
            $(this).removeClass("is-valid is-invalid");
        });
        $("#form select").on("change", function() {
            $(this).removeClass("is-valid is-invalid");
        });
    }

    $(document).ready(() => {
        $('#roleCode').select2({})
        $(".select2-container").addClass('form-control');
    })
</script>