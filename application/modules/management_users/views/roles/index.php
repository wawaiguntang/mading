<div class="card mb-4">
    <div class="card-body px-5 pt-2 pb-2">
        <div class="d-flex justify-content-end">
            <?php echo ((in_array('CR', $userPermission)) ? '<a href="'.base_url('management_users/roles/add').'" class="a-spa"><i class="ri-add-circle-line ri-xl text-success m-3" role="button" title="Create" onclick="addData()"></i></a>' : '') ?>
        </div>
        <div class="table-responsive">
            <?php echo  table('roles', ['Role', 'Action'], ['table-hover py-1 px-0 mx-0']); ?>
        </div>
    </div>
</div>
<script>

    $(document).ready(function() {
        let list = $("#roles").DataTable({
            processing: true,
            serverSide: true,
            order: [],
            ajax: {
                url: base_url + 'management_users/action/roles/list',
                type: "POST",
            },
            columnDefs: [{
                targets: [-1],
                orderable: false,
            }, ],
            language: {
                paginate: {
                    previous: "<",
                    next: ">",
                },
            },
            info: false,
        });
    })

    function deleteData(id) {
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
                    url: base_url + 'management_users/action/roles/delete/' + id,
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

</script>