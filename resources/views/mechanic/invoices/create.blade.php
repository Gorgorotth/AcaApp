@extends('mechanic.layout')
@section('content')
    <div class="container border text-center w-75 my-4">
        <form class="my-4" method="post" id="createPartForm" action="{{route('mechanic.storeInvoice')}}">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="container border mb-4 pb-4" id="invoiceCreateCarInfo">
                        <div class="modal-header">
                            <h4>Add car details</h4>
                        </div>
                        <div class="row my-2">
                            <label for="inputVin" class="col-sm-2 col-form-label">VIN:</label>
                            <div class="col-sm-9">
                                <input type="text" name="inputVin" class="form-control" id="inputVin"
                                       placeholder="1HGEM21991L005461" value="{{old('inputVin')}}" required>
                            </div>
                        </div>
                        <div class="row my-2">
                            <label for="inputPlate" class="col-sm-2 col-form-label">Plate:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="inputPlate" id="inputPlate"
                                       placeholder="ZC-1234"
                                       value="{{old('inputPlate')}}"
                                       required>
                            </div>
                        </div>
                        <div class="row my-2">
                            <label for="inputBrand" class="col-sm-2 col-form-label">Brand:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="inputBrand" id="inputBrand" placeholder="Audi"
                                       value="{{old('inputBrand')}}"
                                       required>
                            </div>
                        </div>
                        <div class="row my-2">
                            <label for="inputModel" class="col-sm-2 col-form-label">Model:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="inputModel" id="inputModel" placeholder="Q8"
                                       value="{{old('inputModel')}}"
                                       required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="container border mb-4 pb-4" id="invoiceCreateCarInfo">
                        <div class="modal-header">
                            <h4>Add owner details</h4>
                        </div>
                        <div class="row my-2">
                            <label for="input-name" class="col-sm-2 col-form-label">Name:</label>
                            <div class="col-sm-9">
                                <input type="text" name="inputClientName" class="form-control" id="input-name"
                                       value="{{old('inputClientName')}}"
                                       placeholder="Required!" >
                            </div>
                        </div>
                        <div class="row my-2">
                            <label for="input-last-name" class="col-sm-3 col-form-label">Last Name:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="inputClientLastName" id="input-last-name"
                                       placeholder="Required!"
                                       value="{{old('inputClientLastName')}}"
                                       required>
                            </div>
                        </div>
                        <div class="row my-2">
                            <label for="input-phone" class="col-sm-2 col-form-label">Phone:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="inputClientPhone" id="input-phone"
                                       value="{{old('inputClientPhone')}}"
                                       placeholder="5553335555"
                                       >
                            </div>
                        </div>
                        <div class="row my-2">
                            <label for="input-email" class="col-sm-2 col-form-label">Email:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="inputClientEmail" id="input-email" placeholder="client@example.com"
                                value="{{old('inputClientEmail')}}"
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="containerLocation" class="row"></div>
            <div class="my-5">
                <button id="add-part-button" data-template="#create-invoice-part" type="button"
                        class="btn btn-outline-primary add-invoice-part">
                    Add part
                </button>
                <button id="add-liquid-button" data-template="#create-invoice-liquid" type="button"
                        class="btn btn-outline-primary add-invoice-part">
                    Add Liquid
                </button>
                <button id="add-work-button" data-template="#create-invoice-work" type="button"
                        class="btn btn-outline-primary add-invoice-part">
                    Add Work
                </button>
            </div>
            @include('mechanic.invoices.templates.add-part-template')
            @include('mechanic.invoices.templates.add-liquid-template')
            @include('mechanic.invoices.templates.add-work-template')
            <button class="btn btn-primary" id="create-invoice" type="submit">Create Invoice</button>
        </form>
        <input type="hidden" value="errore" class="error">
        <input type="hidden" value="creole" class="error">
    </div>
@endsection