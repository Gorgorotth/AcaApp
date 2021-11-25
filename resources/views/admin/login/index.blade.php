@extends('admin.layout')
@section('content')
    <div class="container d-flex justify-content-center my-4">
        <div class="row col-md-4 ">
            <div class="text-center ">
                <strong>LOGIN</strong>
            </div>
            <form method="post" action="{{route('admin.login')}}" class=" border p-4">
                @csrf
                <div class="mb-3">
                    <label for="admin-email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="admin-email" name="email" value="{{old('email')}}"
                           placeholder="email@example.com">
                </div>
                <div class="mb-3">
                    <label for="admin-password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="admin-password" name="password"
                           placeholder="Password">
                </div>
                <div class="mb-3">
                </div>
                <button type="submit" class="btn btn-primary">Log in</button>
            </form>
        </div>
    </div>
@endsection