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
                        <input type="text" name="inputVin" class="form-control" id="inputVin"
                               placeholder="1HGEM21991L005461" required>
                    </div>
                </div>
                <div class="row my-2">
                    <label for="inputPlate" class="col-sm-2 col-form-label">Plate:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="inputPlate" id="inputPlate" placeholder="ZC-1234"
                               required>
                    </div>
                </div>
                <div class="row my-2">
                    <label for="inputBrand" class="col-sm-2 col-form-label">Brand:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="inputBrand" id="inputBrand" placeholder="Audi"
                               required>
                    </div>
                </div>
                <div class="row my-2">
                    <label for="inputModel" class="col-sm-2 col-form-label">Model:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="inputModel" id="inputModel" placeholder="Q8"
                               required>
                    </div>
                </div>
            </div>
            <div id="containerLocation" class="my-4"></div>
            <div class="my-5">
                <button id="add-part-button" data-template="#create-invoice-part" type="button"
                        class="btn btn-outline-primary add-invoice-part">
                    Add part
                </button>
                <button id="add-oil-button" data-template="#create-invoice-oil" type="button"
                        class="btn btn-outline-primary add-invoice-part">
                    Add Oil
                </button>
                <button id="add-work-button" data-template="#create-invoice-work" type="button"
                        class="btn btn-outline-primary add-invoice-part">
                    Add Work
                </button>
            </div>
            @include('mechanic.invoices.templates.add-part-template')
            @include('mechanic.invoices.templates.add-oil-template')
            @include('mechanic.invoices.templates.add-work-template')
            <button class="btn btn-primary" type="submit">Create Invoice</button>
        </form>
    </div>
@endsection