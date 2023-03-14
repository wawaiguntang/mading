<div class="row loading">
    <div class="col-md-8 offset-md-2">
        <div class="card mb-4">
            <div class="card-body px-4 pt-2 pb-2">
                <div class="row mb-3">
                    <div class="d-flex justify-content-between mt-2 py-auto">
                        <i title="back" role="button" class="ri-arrow-left-circle-line ri-lg my-auto text-danger" onclick="backPrevious()"></i>
                        <p class="pl-4 my-auto fw-bolder"> <?php echo $title ?></p>
                    </div>
                </div>
                <?php echo form_open('', ["id" => "form"]); ?>
                <?php echo input('hidden', 'supplierCode', '', [], ["value" => $supplierCode]); ?>
                <?php echo inputWithFormGroup('Supplier', 'text', 'supplier', 'Supplier', [], ["value" => $supplier]); ?>
                <div class="d-flex justify-content-end">
                    <?php echo button('Cancel', ["btn-warning me-2"], ["id" => "btnCancel", "onclick" => "backPrevious()"]); ?>
                    <?php if ($supplierCode) : ?>
                        <?php echo button('Save', ["btn-primary"], ["id" => "btnSave", "onclick" => "saveData('" . base_url('barcode/action/supplier/update/' . $supplierCode) . "')"]); ?>
                    <?php else : ?>
                        <?php echo button('Save', ["btn-primary"], ["id" => "btnSave", "onclick" => "saveData('" . base_url('barcode/action/supplier/add') . "')"]); ?>
                    <?php endif ?>
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