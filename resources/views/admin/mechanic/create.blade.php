@extends('admin.sidebar')
@section('main-content')
    <div class="row">
        <form method="post" id="create-mechanic-form" action="{{route('admin.mechanic.store')}}">
            @csrf
            <div class="col-md-12">
                <h2>Create Mechanic</h2>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="panel-title">Mechanic data</div>
                        <div class="panel-options">
                            <a href="#" data-rel="collapse">
                                <i class="entypo-down-open"></i>
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row form-group">
                            <label for="create-mechanic-name" class="col-md-3 control-label">Name:</label>
                            <div class="col-md-5">
                                <input type="text" name="name" class="form-control" id="create-mechanic-name"
                                       required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="create-mechanic-email" class="col-md-3 control-label">Email:</label>
                            <div class="col-md-5">
                                <input type="text" class="form-control" name="email" id="create-mechanic-email"
                                       required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="create-mechanic-password" class="col-md-3 control-label">Password:</label>
                            <div class="col-md-5">
                                <input type="password" class="form-control" name="password"
                                       id="create-mechanic-password"
                                       required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="create-mechanic-confirm-password" class="col-md-3 control-label">Confirm
                                Password:</label>
                            <div class="col-md-5">
                                <input type="password" class="form-control" name="password_confirmation"
                                       id="create-mechanic-confirm-password"
                                       required>
                                <label id="create-mechanic-error-label" class="text-danger"></label>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="button" class="btn btn-primary" id="create-mechanic-submit-btn">
                                Create Mechanic
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection