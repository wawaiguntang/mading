<div class="row">
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-body  px-4 pt-2 pb-2">
                <div class="d-flex justify-content-end">
                    <?php echo ((in_array('CINFORMATIONLOBBY', $userPermission)) ? '<a href="' . base_url('scientific/index/add') . '" class="a-spa"><i class="ri-add-circle-line ri-xl text-success" role="button" title="Create"></i></a>' : '') ?>
                </div>
                <div class="table-responsive">
                    <?php echo  table('scientific', ['Name', 'Description', 'Action'], ['table-hover py-1 px-0 mx-0']); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        let list = $("#scientific").DataTable({
            processing: true,
            serverSide: true,
            order: [],
            ajax: {
                url: base_url + 'scientific/action/index/list',
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
                    url: base_url + 'scientific/action/index/delete/' + id,
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