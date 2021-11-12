<template id="create-invoice-oil">
    <div class="col-md-6 addPartContainer">
        <div class="my-4 col container border pb-4">
        <div class="row modal-header">
            <h4 class="row" id="partTitle">Add Oil</h4>
            <button type="button" class="mt-3 btn-close add-part-name add-part-close-btn" name="addPartCloseBtn"
                    id="add-part-close-btn"></button>
        </div>
        <div class="row my-2 py-2">
            <label for="add-part-name" class="col-sm-2 col-form-label">Name:</label>
            <div class="col-sm-9">
                <input type="text" class="form-control add-part-name" name="addPartName" id="add-part-name"
                       placeholder="Oil" required>
            </div>
        </div>
        <div class="row my-2">
            <label for="addPartQuantity" class="col-sm-2 col-form-label">Quantity:</label>
            <div class="col-sm-9">
                <input type="text" class="form-control add-part-name" name="addPartQuantity"
                       id="addPartQuantity" placeholder="3.2l" required>
            </div>
        </div>
        <div class="row my-2">
            <label for="addPartPrice" class="col-sm-2 col-form-label">Price:</label>
            <div class="col-sm-9">
                <input type="text" class="form-control add-part-name" name="addPartPrice" id="addPartPrice"
                       placeholder="Per Liter({{$currency}})" required>
            </div>
        </div>
        <div class="row my-2">
            <input type="hidden" class="add-part-name" name="addPartStockNo">
            <input type="hidden" class="add-part-name" name="addPartType"
                   value="{{\App\Models\InvoicePart::JOB_TYPE_LIQUID}}">
        </div>
        </div>
    </div>
</template>