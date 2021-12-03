@extends('mechanic.sidebar')
@section('main-content')
    <h2>Create Invoice</h2>
    <form class="my-4" method="post" id="createPartForm" action="{{route('mechanic.storeInvoice')}}">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-primary" id="invoiceCreateCarInfo">
                    <div class="panel-heading">
                        <div class="panel-title">Add car details</div>
                        <div class="panel-options">
                            <a href="#" data-rel="collapse">
                                <i class="entypo-down-open"></i>
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row form-group">
                            <label for="inputVin" class="col-sm-2 col-form-label">VIN:</label>
                            <div class="col-sm-9">
                                <input type="text" name="inputVin" class="form-control" id="inputVin"
                                       placeholder="1HGEM21991L005461" value="{{old('inputVin')}}" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="inputPlate" class="col-sm-2 col-form-label">Plate:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="inputPlate" id="inputPlate"
                                       placeholder="ZC-1234"
                                       value="{{old('inputPlate')}}"
                                       required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="inputBrand" class="col-sm-2 col-form-label">Brand:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="inputBrand" id="inputBrand"
                                       placeholder="Audi"
                                       value="{{old('inputBrand')}}"
                                       required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="inputModel" class="col-sm-2 col-form-label">Model:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="inputModel" id="inputModel"
                                       placeholder="Q8"
                                       value="{{old('inputModel')}}"
                                       required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-primary" id="invoiceCreateCarInfo">
                    <div class="panel-heading">
                        <div class="panel-title">Add owner details</div>
                        <div class="panel-options">
                            <a href="#" data-rel="collapse">
                                <i class="entypo-down-open"></i>
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row form-group">
                            <label for="input-name" class="col-sm-3 col-form-label">Name:</label>
                            <div class="col-sm-8">
                                <input type="text" name="inputClientName" class="form-control" id="input-name"
                                       value="{{old('inputClientName')}}"
                                       placeholder="Required!">
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="input-last-name" class="col-sm-3 col-form-label">Last Name:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="inputClientLastName" id="input-last-name"
                                       placeholder="Required!"
                                       value="{{old('inputClientLastName')}}"
                                       required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="input-phone" class="col-sm-3 col-form-label">Phone:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="inputClientPhone" id="input-phone"
                                       value="{{old('inputClientPhone')}}"
                                       placeholder="5553335555"
                                >
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="input-email" class="col-sm-3 col-form-label">Email:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="inputClientEmail" id="input-email"
                                       placeholder="client@example.com"
                                       value="{{old('inputClientEmail')}}"
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="add-part-location row"></div>
        <div class="add-liquid-location row"></div>
        <div class="add-work-location row"></div>
        <div class="text-center">
            <button id="add-part-button" data-target=".add-part-location"
                    data-template="#create-invoice-part" type="button"
                    class="btn btn-info add-invoice-part">
                Add part
            </button>
            <button id="add-liquid-button" data-target=".add-liquid-location"
                    data-template="#create-invoice-liquid" type="button"
                    class="btn btn-info add-invoice-part">
                Add Liquid
            </button>
            <button id="add-work-button" data-target=".add-work-location"
                    data-template="#create-invoice-work" type="button"
                    class="btn btn-info add-invoice-part">
                Add Work
            </button>
        </div>
        @include('mechanic.invoices.templates.add-part-template')
        @include('mechanic.invoices.templates.add-liquid-template')
        @include('mechanic.invoices.templates.add-work-template')
        <div class="text-center" style="margin-top: 1%;">
        <button class="btn btn-primary" id="create-invoice" type="submit">Create Invoice</button>
        </div>
    </form>
@endsection