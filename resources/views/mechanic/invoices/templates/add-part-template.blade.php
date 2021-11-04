<template id="create-invoice-part">
    <div class="mx-4 row container border w-auto mb-4 pb-4 addPartContainer">
        <div class="row modal-header">
            <h4 class="row" id="partTitle">Add Part</h4>
            <button type="button" class="mt-3 btn-close add-part-name add-part-close-btn" name="addPartCloseBtn"
                    id="add-part-close-btn"></button>
        </div>
        <div class="row my-2 py-2">
            <label for="add-part-name" class="col-sm-2 col-form-label">Name:</label>
            <div class="col-sm-9">
                <input type="text" class="form-control add-part-name" name="addPartName" id="add-part-name"
                       placeholder="Iberzokna" required>
            </div>
        </div>
        <div class="row my-2">
            <label for="addPartStockNo" class="col-sm-2 col-form-label">StockNo:</label>
            <div class="col-sm-9">
                <input type="text" class="form-control add-part-name" name="addPartStockNo"
                       id="addPartStockNo" placeholder="51859038 MS1022118471" required>
            </div>
        </div>
        <div class="row my-2">
            <label for="addPartQuantity" class="col-sm-2 col-form-label">Quantity:</label>
            <div class="col-sm-9">
                <input type="text" class="form-control add-part-name" name="addPartQuantity"
                       id="addPartQuantity" placeholder="4" required>
            </div>
        </div>
        <div class="row my-2">
            <label for="addPartPrice" class="col-sm-2 col-form-label">Price:</label>
            <div class="col-sm-9">
                <input type="text" class="form-control add-part-name" name="addPartPrice" id="addPartPrice"
                       placeholder="Per part({{$currency}})" required>
            </div>
        </div>
        <div class="row my-2">
            <input type="hidden" class="add-part-name" name="addPartType"
                   value="{{\App\Models\InvoicePart::JOB_TYPE_PART}}">
        </div>
    </div>
</template>
