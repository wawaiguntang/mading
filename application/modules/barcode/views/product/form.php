<div class="row loading">
    <div class="col-md-10 offset-md-1">
        <div class="card mb-4">
            <div class="card-body  px-4 pt-2 pb-2">
                <div class="row mb-3">
                    <div class="d-flex justify-content-between mt-2 py-auto">
                        <i title="back" role="button" class="ri-arrow-left-circle-line ri-lg my-auto text-danger" onclick="backPrevious()"></i>
                        <p class="pl-4 my-auto fw-bolder"> <?php echo $title ?></p>
                    </div>
                </div>
                <?php echo form_open('', ["id" => "form"]); ?>
                <?php echo input('hidden', 'productCode', '', [], ["value" => $productCode]); ?>
                <?php echo inputWithFormGroup('Name', 'text', 'name', 'Name', [], ["value" => $name]); ?>
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-12">
                        <?php echo inputWithFormGroup('Code', 'text', 'code', 'Code', [], ["value" => $code]); ?>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <?php echo inputWithFormGroup('Quantity', 'number', 'quantity', 'Quantity', [], ["value" => $quantity]); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <?php echo inputWithFormGroup('Buy Price', 'number', 'buyPrice', 'Buy Price', [], ["value" => $buyPrice]); ?>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <?php echo inputWithFormGroup('Sell Price', 'number', 'sellPrice', 'Sell Price', [], ["value" => $sellPrice]); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <?php echo selectWithFormGroup('categoryCode', 'Category', 'categoryCode', [], $categoryCode, [], ["type" => "text"]) ?>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <?php echo selectWithFormGroup('unitCode', 'Unit', 'unitCode', [], $unitCode, [], ["type" => "text"]) ?>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <?php echo selectWithFormGroup('supplierCode', 'Supplier', 'supplierCode', [], $supplierCode, [], ["type" => "text"]) ?>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <?php echo button('Cancel', ["btn-warning me-2"], ["id" => "btnCancel", "onclick" => "backPrevious()"]); ?>
                    <?php if ($productCode) : ?>
                        <?php echo button('Save', ["btn-primary"], ["id" => "btnSave", "onclick" => "saveData('" . base_url('barcode/action/product/update/' . $productCode) . "')"]); ?>
                    <?php else : ?>
                        <?php echo button('Save', ["btn-primary"], ["id" => "btnSave", "onclick" => "saveData('" . base_url('barcode/action/product/add') . "')"]); ?>
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

    $('#categoryCode').select2({
        ajax: {
            url: base_url + 'barcode/action/product/getCategory' + <?php echo (($categoryCode) ? "'/" . $categoryCode . "'" : "''") ?>,
            dataType: 'json',
            delay: 250,
            processResults: function(data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });
    <?php if ($productCode) : ?>
        if ($('#categoryCode').find("option[value='" + <?php echo $categoryCode ?> + "']").length) {
            $('#categoryCode').val(<?php echo $categoryCode ?>).trigger('change');
        } else {
            var newOption = new Option('<?php echo $category ?>', <?php echo $categoryCode ?>, true, true);
            $('#categoryCode').append(newOption).trigger('change');
        }
    <?php endif ?>
    $('#unitCode').select2({
        ajax: {
            url: base_url + 'barcode/action/product/getUnit' + <?php echo (($unitCode) ? "'/" . $unitCode . "'" : "''") ?>,
            dataType: 'json',
            delay: 250,
            processResults: function(data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });
    <?php if ($productCode) : ?>
        if ($('#unitCode').find("option[value='" + <?php echo $unitCode ?> + "']").length) {
            $('#unitCode').val(<?php echo $unitCode ?>).trigger('change');
        } else {
            var newOption = new Option('<?php echo $unit ?>', <?php echo $unitCode ?>, true, true);
            $('#unitCode').append(newOption).trigger('change');
        }
    <?php endif ?>
    $('#supplierCode').select2({
        ajax: {
            url: base_url + 'barcode/action/product/getSupplier' + <?php echo (($supplierCode) ? "'/" . $supplierCode . "'" : "''") ?>,
            dataType: 'json',
            delay: 250,
            processResults: function(data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });
    <?php if ($productCode) : ?>
        if ($('#supplierCode').find("option[value='" + <?php echo $supplierCode ?> + "']").length) {
            $('#supplierCode').val(<?php echo $supplierCode ?>).trigger('change');
        } else {
            var newOption = new Option('<?php echo $supplier ?>', <?php echo $supplierCode ?>, true, true);
            $('#supplierCode').append(newOption).trigger('change');
        }
    <?php endif ?>
    $(".select2-container").addClass('form-control');
</script>