@extends('admin.sidebar', ['attribute' => 'disabled'])
@section('main-content')
    <h2>Create Garage</h2>
    <div class="row">
        <form method="post" id="createPartForm"
              action="{{route('admin.garage.store')}}">
            @csrf
            <div class="col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="panel-title">Garage data</div>
                        <div class="panel-options">
                            <a href="#" data-rel="collapse">
                                <i class="entypo-down-open"></i>
                            </a>
                        </div>
                    </div>
                    <div class="panel-body" id="invoiceCreateCarInfo">
                        <div class="row form-group">
                            <label for="garage-name" class="col-md-3 control-label">Name:</label>
                            <div class="col-sm-7">
                                <input type="text" name="name" class="form-control" id="garage-name"
                                       value="{{old('name')}}" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="garage-address" class="col-md-3 control-label">Address:</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" name="address" id="garage-address"
                                       value="{{old('address')}}"
                                       required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="garage-hourly-price" class="col-md-3 control-label">Hourly Price:</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" name="hourlyPrice" id="garage-hourly-price"
                                       placeholder="CHF/h"
                                       value="{{old('hourlyPrice')}}"
                                       required>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer text-center">
                        <button class="btn btn-primary" id="create-garage" type="submit">Create Garage</button>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="panel-title">Add garage emails</div>
                                <div class="panel-options">
                                    <a href="#" data-rel="collapse">
                                        <i class="entypo-down-open"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="add-garage-email-here">

                                </div>
                            </div>
                            <div class="panel-footer text-center">
                                <button id="add-email-to-garage" data-template="#add-garage-email"
                                        data-target=".add-garage-email-here"
                                        data-times-clicked="addEmailBtnTimesClicked"
                                        type="button"
                                        class="btn btn-info add-item-to-garage">
                                    Add Email
                                </button>
                                @include('admin.garage.templates.add-email-template')
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="panel-title">Add garage mechanics</div>
                                <div class="panel-options">
                                    <a href="#" data-rel="collapse">
                                        <i class="entypo-down-open"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="add-garage-mechanic-here">
                                </div>
                            </div>
                            <div class="panel-footer text-center">
                                <button id="add-mechanic-to-garage" data-template="#add-garage-mechanic"
                                        data-target=".add-garage-mechanic-here"
                                        data-times-clicked="addMechanicBtnTimesClicked" type="button"
                                        class="btn btn-info add-item-to-garage">
                                    Add Mechanic
                                </button>
                                @include('admin.garage.templates.add-mechanic-template')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection