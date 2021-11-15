@extends('admin.layout')
@section('content')
    <div class="container border text-center w-75 my-4">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
                <div class="container border mb-4 pb-4" id="invoiceCreateCarInfo">
                    <form class="my-4" method="post" id="createPartForm" action="{{route('admin.store-garage')}}">
                        @csrf
                        <div class="modal-header">
                            <h4>Create Garage</h4>
                        </div>
                        <div class="row my-2">
                            <label for="garage-name" class="col-md-3 col-form-label">Name:</label>
                            <div class="col-md-9">
                                <input type="text" name="name" class="form-control" id="garage-name"
                                       placeholder="" required>
                            </div>
                        </div>
                        <div class="row my-2">
                            <label for="garage-address" class="col-md-3 col-form-label">Address:</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="address" id="garage-address"
                                       placeholder="/\"
                                       required>
                            </div>
                        </div>
                        <div class="row my-2">
                            <label for="garage-hourly-price" class="col-md-3 col-form-label">Hourly Price:</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="hourlyPrice" id="garage-hourly-price"
                                       placeholder="CHF/hour"
                                       required>
                            </div>
                        </div>
                        <div class="add-garage-email-here border-top">

                        </div>
                        <div class="add-garage-mechanic-here border-top border-bottom">

                        </div>
                        <div class="my-5">
                            <button id="add-email-to-garage" data-template="#add-garage-email"
                                    data-target=".add-garage-email-here" data-times-clicked="addEmailBtnTimesClicked"
                                    type="button"
                                    class="btn btn-outline-primary add-item-to-garage">
                                Add Email
                            </button>
                            <button id="add-mechanic-to-garage" data-template="#add-garage-mechanic"
                                    data-target=".add-garage-mechanic-here"
                                    data-times-clicked="addMechanicBtnTimesClicked" type="button"
                                    class="btn btn-outline-primary add-item-to-garage">
                                Add Mechanic
                            </button>
                        </div>
                        @include('admin.templates.add-email-template')
                        @include('admin.templates.add-mechanic-template')
                        <button class="btn btn-primary" id="create-garage" type="submit">Create Garage</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection