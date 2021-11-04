<template id="create-invoice-work">
    <div class="mx-4 row container border w-auto mb-4 pb-4 addPartContainer">
        <div class="row modal-header">
            <h4 class="row" id="partTitle">Add Work</h4>
            <button type="button" class="mt-3 btn-close add-part-name add-part-close-btn" name="addPartCloseBtn"
                    id="add-part-close-btn"></button>
        </div>
        <div class="row my-2 py-2">
            <label for="add-part-name" class="col-sm-2 col-form-label">Name:</label>
            <div class="col-sm-8">
                <input type="text" class="form-control add-part-name" name="addPartName" id="add-part-name"
                       placeholder="Tire replacement" required>
            </div>
        </div>
        <div class="row my-2 p-0">
            <label for="addPartQuantity" class="col-sm-3 col-form-label">Hours required:</label>
            <div class="col-sm-9">
                <input type="text" class="form-control add-part-name" name="addPartQuantity"
                       id="addPartQuantity" placeholder="2.6(h)" required>
            </div>
        </div>
        <div class="row my-2">
            <input type="hidden" class="add-part-name" name="addPartPrice">
            <input type="hidden" class="add-part-name" name="addPartStockNo">
            <input type="hidden" class="add-part-name" name="addPartType"
                   value="{{\App\Models\InvoicePart::JOB_TYPE_WORK}}">
        </div>
    </div>
</template>