@extends('admin.layout')
@section('content')
    <div class="container text-center d-flex justify-content-between my-4">
        <div class="col-md-4">
            <table class="table table-bordered w-100 h-25 overflow-scroll">
                <thead>
                <tr class="text-center">
                    <th class="col-md-8">
                        <div class="form-switch">
                            <input type="checkbox" id="show-deleted-emails"
                                   data-target=".show-deleted-email-here"
                                   class="form-check-input">
                            <label for="show-deleted-emails" class="form-check-label">Show deleted Emails</label>
                        </div>
                        Garage Emails
                    </th>
                    <th class="col-md-4 pb-4">
                        Delete Email
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($deletedEmails as $deletedEmail)
                    <tr class="bg-danger bg-opacity-25 show-deleted-email-here" style="display: none">
                        <th>
                            {{$deletedEmail['email']}}
                        </th>
                        <th>
                            <form method="post" action="{{route('admin.garage-restore-email', ['emailId' => $deletedEmail['id']])}}">
                                @csrf
                            <button class="btn btn-outline-info btn-light">Restore</button>
                            </form>
                        </th>
                    </tr>
                @endforeach
                @foreach($garageEmails as $email)
                    <tr class="text-center">
                        <th>
                            {{$email['email']}}
                        </th>
                        <th>
                            <form method="post"
                                  action="{{route('admin.garage-delete-email', ['emailId' => $email['id']])}}">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger">
                                    Delete
                                </button>
                            </form>
                        </th>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-4">
            <form class="mx-2" method="post" action="{{route('admin.garage.update', ['garage' => $garage['id']])}}">
                @csrf
                @method('put')
                <div class="container border mb-4 pb-4">
                    <div class="modal-header">
                        <h4>Edit Garage</h4>
                    </div>
                    <div class="row my-2">
                        <label for="name" class="col-md-2 col-form-label">Name:</label>
                        <div class="col-sm-9">
                            <input type="text" name="name" class="form-control" id="name"
                                   value="{{$garage['name']}}" required>
                        </div>
                    </div>
                    <div class="row my-2">
                        <label for="address" class="col-md-2 col-form-label">Address:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="address" id="address"
                                   value="{{$garage['address']}}" required>
                        </div>
                    </div>
                    <div class="row my-2">
                        <label for="hourly-rate" class="col-md-2 col-form-label">Price/h:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="hourlyRate" id="hourly-rate"
                                   value="{{$garage['hourly_rate']}}" required>
                        </div>
                    </div>
                    <div class="add-garage-email-here border-top">

                    </div>
                    <div class="add-garage-mechanic-here border-top border-bottom">

                    </div>
                    <div>
                        <div class="btn">
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
                        @include('admin.garage.templates.add-email-template')
                        @include('admin.garage.templates.add-mechanic-template')
                    </div>
                    <div class="mt-3">
                        <button class="btn btn-outline-primary">Edit</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-4">
            <table class="table table-bordered">
                <thead>
                <tr class="text-center">
                    <th class="col-md-7">
                        Garage Mechanics
                    </th>
                    <th class="col-md-5">
                        Remove Mechanic
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($garageMechanics as $mechanic)
                    <tr class="text-center">
                        <th>
                            {{$mechanic['name']}}
                        </th>
                        <th>
                            <form method="post"
                                  action="{{route('admin.garage-remove-mechanic', ['mechanicId' => $mechanic['id']])}}">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger">
                                    Remove
                                </button>
                            </form>
                        </th>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>
    </div>
@endsection