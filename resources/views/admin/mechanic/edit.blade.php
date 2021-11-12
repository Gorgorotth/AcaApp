@extends('admin.layout')
@section('content')
    <div class="container text-center d-flex justify-content-center w-75 my-4">
        <div class="col-md-6">
            <form class="my-4" method="post" action="{{route('admin.update-mechanic')}}">
                @csrf
                <div class="container border mb-4 pb-4">
                    <div class="modal-header">
                        <h4>Edit Profile</h4>
                    </div>
                    <div class="row my-2">
                        <label for="name" class="col-sm-2 col-form-label">Name:</label>
                        <div class="col-sm-9">
                            <input type="text" name="name" class="form-control" id="name"
                                   placeholder="{{$name}}">
                        </div>
                    </div>
                    <div class="row my-2">
                        <label for="email" class="col-sm-2 col-form-label">Email:</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" name="email" id="email"
                                   placeholder="{{$email}}">
                        </div>
                    </div>
                    <div class="row my-2">
                        <label for="garage" class="col-sm-2 col-form-label">Garage:</label>
                        <div class="col-sm-9">
                            <select class="form-select" name="garage" id="garage">
                                <option value="-1" selected>Select Garage</option>
                                <option value="5">2 Garage</option>
                                @foreach($garages as $garage)
                                    <option value="{{$garage->id}}">{{$garage->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button class="btn btn-outline-primary">Edit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection