<template id="create-invoice-work">
    <div class="col-md-6 addPartContainer">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="panel-title">Add Work</div>
                <div class="panel-options">
                    <a href="#" data-rel="collapse">
                        <i class="entypo-down-open"></i>
                    </a>
                    <span class="cursor-pointer add-part-name add-part-close-btn"
                          id="add-part-close-btn">
                    <i class="entypo-cancel"></i>
                </span>
                </div>
            </div>
            <div class="panel-body">
                <div class="row form-group">
                    <label for="add-part-name" class="col-sm-2 col-form-label">Name:</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control add-part-name" name="addPartName" id="add-part-name"
                               placeholder="Tire replacement" required>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="addPartQuantity" class="col-sm-3 col-form-label">Hours required:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control add-part-name" name="addPartQuantity"
                               id="addPartQuantity" placeholder="2.6(h)" required>
                    </div>
                </div>
                <div class="row">
                    <input type="hidden" class="add-part-name" name="addPartPrice">
                    <input type="hidden" class="add-part-name" name="addPartStockNo">
                    <input type="hidden" class="add-part-name" name="addPartType"
                           value="{{\App\Models\InvoicePart::JOB_TYPE_WORK}}">
                </div>
            </div>
        </div>
    </div>
</template>