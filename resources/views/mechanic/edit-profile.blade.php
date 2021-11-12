@extends('mechanic.layout')
@section('content')
    <div class="container border text-center w-75 my-4">
        <div class="row">
            <div class="col-md-6">
                <form class="my-4" method="post" action="{{route('mechanic.edit-mechanic-profile')}}">
                    @csrf

                    <div class="container border mb-4 pb-4">
                        <div class="modal-header">
                            <h4>Edit Profile</h4>
                        </div>
                        <div class="row my-2">
                            <label for="name" class="col-sm-2 col-form-label">Name:</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" class="form-control" id="name"
                                       placeholder="{{$name}}" required>
                            </div>
                        </div>
                        <div class="row my-2">
                            <label for="email" class="col-sm-2 col-form-label">Email:</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" name="email" id="email"
                                       placeholder="{{$email}}" required>
                            </div>
                        </div>
                        <div class="row my-2">
                            <label for="password" class="col-sm-2 col-form-label">Password:</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" name="password" id="password"
                                       placeholder="Your password" required>
                                <label id="wrong-password-label" class="text-danger"></label>
                            </div>
                        </div>
                        <div class="mt-3">
                            <button class="btn btn-outline-primary">Edit</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <form class="my-4" method="post" id="changeMechanicPassword" action="{{route('mechanic.change-mechanic-password')}}">
                    @csrf
                    <div class="container border mb-4 pb-4">
                        <div class="modal-header">
                            <h4>Change Password</h4>
                        </div>
                        <div class="row my-2">
                            <label for="current-password" class="col-sm-5 col-form-label">Current Password:</label>
                            <div class="col-sm-7">
                                <input type="password" name="currentPassword" class="form-control" id="current-password"
                                       placeholder="Current password" required>
                            </div>
                        </div>
                        <div class="row my-2">
                            <label for="new-password" class="col-sm-5 col-form-label">New Password:</label>
                            <div class="col-sm-7">
                                <input type="password" class="form-control" name="newPassword" id="new-password"
                                       placeholder="New Password" required>
                            </div>
                        </div>
                        <div class="row my-2">
                            <label for="confirm-password" class="col-sm-5 col-form-label">Confirm Password:</label>
                            <div class="col-sm-7">
                                <input type="password" class="form-control" name="confirmPassword" id="confirm-password"
                                       placeholder="Confirm Password" required>
                                <label id="wrong-password-label" class="text-danger"></label>
                            </div>
                        </div>
                        <div class="mt-3">
                            <button class="btn btn-outline-primary" id="changeMechanicPasswordBtn">Change Password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection