@extends('admin.sidebar', ['attribute' => 'disabled'])
@section('main-content')
    <div class="row">
        <div class="breadcrumb bc-3 text-center">
            <h4>Edit Garage</h4>
        </div>
        <div class="col-md-8">
            <table class="table table-bordered w-100 h-25 overflow-scroll">
                <thead>
                <tr class="text-center">
                    <th class="col-md-8">
                        <div class="form-switch">
                            <input type="checkbox" id="show-deleted-emails"
                                   data-target=".show-deleted-email-here"
                                   class="form-check-input" {{session()->get('checkboxChecked') ?? ''}}>
                            <label for="show-deleted-emails" class="form-check-label">Show deleted Emails</label>
                        </div>
                        Garage Emails
                    </th>
                    <th class="col-sm-2 pb-4">
                        Delete Email
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($deletedEmails as $deletedEmail)
                    <tr class="show-deleted-email-here" style="display: none">
                        <th class="text-danger">
                            {{$deletedEmail['email']}}
                        </th>
                        <th class="text-center">
                            <form method="post"
                                  action="{{route('admin.garage-restore-email', ['emailId' => $deletedEmail['id']])}}">
                                @csrf
                                <button class="btn btn-info btn-sm">Restore</button>
                            </form>
                        </th>
                    </tr>
                @endforeach
                @foreach($garageEmails as $email)
                    <tr class="text-center">
                        <th>
                            {{$email['email']}}
                        </th>
                        <th class="text-center">
                            <form method="post"
                                  action="{{route('admin.garage-delete-email', ['emailId' => $email['id']])}}">
                                @csrf
                                <button type="submit" class="btn btn-danger">
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
            <table class="table table-bordered">
                <thead>
                <tr class="text-center">
                    <th class="col-md-7">
                        Garage Mechanics
                    </th>
                    <th class="col-md-4">
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
                        <th class="text-center">
                            <form method="post"
                                  action="{{route('admin.garage-remove-mechanic', ['mechanicId' => $mechanic['id']])}}">
                                @csrf
                                <button type="submit" class="btn btn-danger">
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
    <form class="mx-2" method="post" action="{{route('admin.garage.update', ['garage' => $garage['id']])}}">
        @csrf
        @method('put')
        <div class="col-md-12">
            <div class="panel panel-primary">

                <div class="panel-heading">
                    <div class="panel-title">Garage data</div>
                    <div class="panel-options">
                        <a href="#" data-rel="collapse">
                            <i class="entypo-down-open"></i>
                        </a>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row form-group">
                        <label for="name" class="col-md-2 control-label">Name:</label>
                        <div class="col-sm-9">
                            <input type="text" name="name" class="form-control" id="name"
                                   value="{{$garage['name']}}" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="address" class="col-md-2 control-label">Address:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="address" id="address"
                                   value="{{$garage['address']}}" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="hourly-rate" class="col-md-2 control-label">Price/h:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="hourlyRate" id="hourly-rate"
                                   value="{{$garage['hourly_rate']}}" required>
                        </div>
                    </div>

                </div>
                <div class="panel-footer text-center">
                    <button class="btn btn-primary">Edit</button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
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
                    <div class="panel-footer">
                        <button id="add-email-to-garage"
                                data-template="#add-garage-email"
                                data-target=".add-garage-email-here"
                                data-times-clicked="addEmailBtnTimesClicked"
                                type="button"
                                class="btn btn-outline-primary add-item-to-garage">
                            Add Email
                        </button>
                        @include('admin.garage.templates.add-email-template')
                    </div>
                </div>
            </div>
            <div class="col-md-4">
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
                    <div class="panel-footer">
                        <button id="add-mechanic-to-garage" data-template="#add-garage-mechanic"
                                data-target=".add-garage-mechanic-here"
                                data-times-clicked="addMechanicBtnTimesClicked" type="button"
                                class="btn btn-outline-primary add-item-to-garage">
                            Add Mechanic
                        </button>
                        @include('admin.garage.templates.add-mechanic-template')
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection