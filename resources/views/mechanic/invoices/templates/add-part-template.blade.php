<template id="create-invoice-part">
    <div class="col-md-6 addPartContainer">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="panel-title">Add Part</div>
                <div class="panel-options">
                    <a href="#" data-rel="collapse">
                        <i class="entypo-down-open"></i>
                    </a>
                    <span   class="cursor-pointer add-part-name add-part-close-btn"
                            id="add-part-close-btn">
                        <i class="entypo-cancel"></i>
                    </span>
                </div>
            </div>
            <div class="panel-body">
                <div class="row form-group">
                    <label for="add-part-name" class="col-sm-2 col-form-label">Name:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control add-part-name" name="addPartName" id="add-part-name"
                               placeholder="Iberzokna" required>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="addPartStockNo" class="col-sm-2 col-form-label">StockNo:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control add-part-name" name="addPartStockNo"
                               id="addPartStockNo" placeholder="51859038 MS1022118471" required>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="addPartQuantity" class="col-sm-2 col-form-label">Quantity:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control add-part-name" name="addPartQuantity"
                               id="addPartQuantity" placeholder="4" required>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="addPartPrice" class="col-sm-2 col-form-label">Price:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control add-part-name" name="addPartPrice" id="addPartPrice"
                               placeholder="Per part({{$currency}})" required>
                    </div>
                </div>
                <div>
                    <input type="hidden" class="add-part-name" name="addPartType"
                           value="{{\App\Models\InvoicePart::JOB_TYPE_PART}}">
                </div>
            </div>
        </div>
    </div>
</template>
