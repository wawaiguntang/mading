<div class="col-md-6 offset-md-3">
    <div class="card mb-4">
        <div class="card-body px-5 pt-3 pb-3">
            <div class="d-flex justify-content-between">
                <i title="back" role="button" class="ri-arrow-left-circle-line ri-lg my-auto text-danger" onclick="backPrevious()"></i>
                <h6 class="font-weight-bolder mb-0">Data </h6>
            </div>
            <div class="row mt-4">
                <div class="table-responsive">
                    <table class="table table-sm table-borderless">

                        <tr>
                            <td class="p-1 fw-bold">Email</td>
                            <td class="p-1">:</td>
                            <td class="p-1"><?php echo $email ?></td>
                        </tr>
                        <tr>
                            <td class="p-1 fw-bold d-flex">Role <?php echo ((in_array('CRU', $userPermission)) ? '<a href="' . base_url('management_users/users/role/' . $userCode) . '" class="a-spa"><i class="ri-add-circle-line ri-lg text-success my-auto" role="button" title="Add Role"></i></a>' : '') ?></td>
                            <td class="p-1">:</td>
                            <td class="p-1"><?php echo $roleHTML ?></td>
                        </tr>
                        <tr>
                            <td class="p-1 fw-bold d-flex">Special Permission <?php echo ((in_array('CUP', $userPermission)) ? '<a href="' . base_url('management_users/users/permission/' . $userCode) . '" class="a-spa"><i class="ri-add-circle-line ri-lg text-success my-auto" role="button" title="Add Special Permission" ></i></a>' : '') ?></td>
                            <td class="p-1">:</td>
                            <td class="p-1"><?php echo $specialPermissionHTML ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    
    var save_label = "add";

    function deleteRole(id) {
        Swal.fire({
            title: "Apa kamu yakin?",
            text: "Data akan dihapus!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#084594",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya hapus!",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: base_url + 'management_users/action/users/deleteRole/' + id,
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
                        loadingOff()
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert("Error get data from ajax");
                        loadingOff()
                    },
                });
            }
        });
    }

    function deletePermission(id) {
        Swal.fire({
            title: "Apa kamu yakin?",
            text: "Data akan dihapus!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#084594",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya hapus!",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: base_url + 'management_users/action/users/deletePermission/' + id,
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
                        loadingOff()
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert("Error get data from ajax");
                        loadingOff()
                    },
                });
            }
        });
    }
</script>