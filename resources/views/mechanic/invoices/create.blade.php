@extends('mechanic.layout')
@section('content')
    <div class="container border text-center w-50 my-4">
        <form class="my-4" method="post" id="createPartForm" action="{{route('mechanic.storeInvoice')}}">
            @csrf
            <div class="mx-4 container border w-auto mb-4 pb-4" id="invoiceCreateCarInfo">
                <div class="modal-header">
                    <h4>Add car details</h4>
                </div>
                <div class="row my-2">
                    <label for="inputVin" class="col-sm-2 col-form-label">VIN:</label>
                    <div class="col-sm-9">
                        <input type="text" name="inputVin" class="form-control" id="inputVin" required>
                    </div>
                </div>
                <div class="row my-2">
                    <label for="inputPlate" class="col-sm-2 col-form-label">Plate:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="inputPlate" id="inputPlate" placeholder="ZC-1234" required>
                    </div>
                </div>
                <div class="row my-2">
                    <label for="inputBrand" class="col-sm-2 col-form-label">Brand:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="inputBrand" id="inputBrand" required>
                    </div>
                </div>
                <div class="row my-2">
                    <label for="inputModel" class="col-sm-2 col-form-label">Model:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="inputModel" id="inputModel" required>
                    </div>
                </div>
            </div>
            <div id="containerLocation" class="my-4">

            </div>
            <div class="my-5">
                <button id="addPartButton" type="button" class="btn btn-outline-primary">
                    Add job
                </button>
            </div>
            <template id="createInvoicePart">
                <div class="mx-4 row container border w-auto mb-4 pb-4 addPartContainer">
                    <div class="row modal-header">
                        <h4 class="row" id="partTitle">Add part/work</h4>
                        <button type="button" class="mt-3 btn-close addPartName addPartCloseBtn" name="addPartCloseBtn" id="addPartCloseBtn"></button>
                    </div>
                    <div class="row my-2 py-2">
                        <label for="addPartName" class="col-sm-2 col-form-label">Name:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control addPartName" name="addPartName" id="addPartName" required>
                        </div>
                    </div>
                    <div class="row my-2">
                        <label for="addPartStockNo" class="col-sm-2 col-form-label">StockNo:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control addPartName" name="addPartStockNo" id="addPartStockNo">
                        </div>
                    </div>
                    <div class="row my-2">
                        <label for="addPartQuantity" class="col-sm-2 col-form-label">Quantity:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control addPartName" name="addPartQuantity" id="addPartQuantity" required>
                        </div>
                    </div>
                    <div class="row my-2">
                        <label for="addPartPrice" class="col-sm-2 col-form-label">Price:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control addPartName" name="addPartPrice" id="addPartPrice">
                        </div>
                    </div>
                    <div class="row my-2">
                        <label for="addPartType" class="col-sm-2 col-form-label">Type:</label>
                        <div class="col-sm-9">
                            <select class="form-select addPartName" name="addPartType" id="addPartType" required>
                                <option value="{{\App\Models\InvoicePart::JOB_TYPE_PART}}">Part</option>
                                <option value="{{\App\Models\InvoicePart::JOB_TYPE_LIQUID}}">Liquids</option>
                                <option value="{{\App\Models\InvoicePart::JOB_TYPE_WORK}}">Work</option>
                            </select>
                        </div>
                    </div>
                </div>
            </template>
            <button class="btn btn-primary" type="submit">Create Invoice</button>
        </form>
    </div>
@endsection