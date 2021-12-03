@extends('mechanic.sidebar')
@section('main-content')
    <div class="row">
        <div class="col-md-6">
            <form method="post" action="{{route('mechanic.edit-mechanic-profile')}}">
                @csrf
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="panel-title">Edit Profile</div>
                        <div class="panel-options">
                            <a href="#" data-rel="collapse">
                                <i class="entypo-down-open"></i>
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row form-group">
                            <label for="name" class="col-sm-2 col-form-label">Name:</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" class="form-control" id="name"
                                       value="{{$name}}" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="email" class="col-sm-2 col-form-label">Email:</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" name="email" id="email"
                                       value="{{$email}}" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="password" class="col-sm-2 col-form-label">Password:</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" name="password" id="password"
                                       placeholder="Your password" required>
                            </div>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-info">
                                <i class="entypo-cog">Edit</i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-6">
            <form method="post" id="changeMechanicPassword"
                  action="{{route('mechanic.change-mechanic-password')}}">
                @csrf
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="panel-title">Change Password</div>
                        <div class="panel-options">
                            <a href="#" data-rel="collapse">
                                <i class="entypo-down-open"></i>
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row form-group">
                            <label for="current-password" class="col-sm-5 col-form-label">Current Password:</label>
                            <div class="col-sm-7">
                                <input type="password" name="currentPassword" class="form-control" id="current-password"
                                       placeholder="Current password" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="new-password" class="col-sm-5 col-form-label">New Password:</label>
                            <div class="col-sm-7">
                                <input type="password" class="form-control" name="password" id="new-password"
                                       placeholder="New Password" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="confirm-password" class="col-sm-5 col-form-label">Confirm Password:</label>
                            <div class="col-sm-7">
                                <input type="password" class="form-control" name="password_confirmation"
                                       id="confirm-password"
                                       placeholder="Confirm Password" required>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-info">
                                <i>Change Password</i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection