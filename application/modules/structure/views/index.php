<div class="row">
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-body  px-4 pt-2 pb-2">
                <?php echo form_open('', ["id" => "form"]); ?>
                <div class="form-group">
                    <label for="description">Deskripsi</label>
                    <textarea class="form-control" id="description" name="description" rows="3"><?php echo $description ?></textarea>
                </div>
                <div class="d-flex justify-content-end">
                    <?php echo button('Save', ["btn-primary"], ["id" => "btnSave", "onclick" => "saveHere('" . base_url('structure/action/index/updateDesc') . "')"]); ?>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-body px-4 pt-2 pb-2">
                <div class="d-flex justify-content-end">
                    <?php echo ((in_array('CSTRUCTURE', $userPermission)) ? '<a href="' . base_url('structure/index/add') . '" class="a-spa"><i class="ri-add-circle-line ri-xl text-success" role="button" title="Create"></i></a>' : '') ?>
                </div>
                <div id="structureList"></div>
            </div>
        </div>
    </div>
</div>
<style>
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

    .wtree li span {
        display: block;
        border: 1px solid #ddd;
        padding: 10px;
        color: #888;
        text-decoration: none;
    }

    .wtree li span:hover,
    .wtree li span:focus {
        background: #eee;
        color: #000;
        border: 1px solid #aaa;
    }

    .wtree li span:hover+ul li span,
    .wtree li span:focus+ul li span {
        background: #eee;
        color: #000;
        border: 1px solid #aaa;
    }

    .wtree li span:hover+ul li:after,
    .wtree li span:hover+ul li:before,
    .wtree li span:focus+ul li:after,
    .wtree li span:focus+ul li:before {
        border-color: #aaa;
    }
</style>
<script>
    $(document).ready(function() {
        listData();
    })

    function listData() {
        $.ajax({
            url: base_url + 'structure/action/index/list',
            type: "POST",
            success: function(data) {
                if (data.status) {
                    $("#structureList").html(data.structure);
                } else {
                    handleError(data);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Error get data from ajax");
            },
        });
    }

    function deleteData(id) {
        Swal.fire({
            title: "Are you sure?",
            text: "Data cannot will be back if you delete it!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#084594",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes delete!",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: base_url + 'structure/action/index/delete/' + id,
                    type: "POST",

                    beforeSend: function() {
                        loadingOn()
                    },
                    success: function(data) {
                        if (data.status) {
                            loadPage(document.location, true);
                            handleToast("success", data.message);
                        } else {
                            handleError(data);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert("Error get data from ajax");
                    },
                });
            }
        });
    }

    function saveHere(url, btnId = "btnSave", formId = "form") {
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