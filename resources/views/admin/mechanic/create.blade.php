@extends('admin.layout')
@section('content')
    <div class="row mt-4 d-flex justify-content-center">
        <div class="col-md-4">
            <div class="container border" id="invoiceCreateCarInfo">
                <form method="post" id="create-mechanic-form" action="{{route('admin.mechanic.store')}}">
                    @csrf
                    <div class="modal-header">
                        <h4>Create Mechanic</h4>
                    </div>
                    <div class="row my-2">
                        <label for="create-mechanic-name" class="col-md-3 col-form-label">Name:</label>
                        <div class="col-md-9">
                            <input type="text" name="name" class="form-control" id="create-mechanic-name"
                                   required>
                        </div>
                    </div>
                    <div class="row my-2">
                        <label for="create-mechanic-email" class="col-md-3 col-form-label">Email:</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="email" id="create-mechanic-email"
                                   required>
                        </div>
                    </div>
                    <div class="row my-2">
                        <label for="create-mechanic-password" class="col-md-3 col-form-label">Password:</label>
                        <div class="col-md-9">
                            <input type="password" class="form-control" name="password" id="create-mechanic-password"
                                   required>
                        </div>
                    </div>
                    <div class="row my-2">
                        <label for="create-mechanic-confirm-password" class="col-md-5 col-form-label">Confirm
                            Password:</label>
                        <div class="col-md-7">
                            <input type="password" class="form-control" name="password_confirmation"
                                   id="create-mechanic-confirm-password"
                                   required>
                            <label id="create-mechanic-error-label" class="text-danger"></label>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="button" class="btn btn-outline-primary my-3" id="create-mechanic-submit-btn">
                            Create Mechanic
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection