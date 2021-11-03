@extends('mechanic.layout')
@section('content')
    <div class="container my-4">
        <div class="text-center">
            <strong>LOGIN</strong>
        </div>
    <form method="post" action="{{route('mechanic.login')}}" class="border p-4">
        @csrf
        <div class="mb-3">
            <label for="mechanic-email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="mechanic-email" name="email" value="{{old('email')}}" placeholder="email@example.com">
        </div>
        <div class="mb-3">
            <label for="mechanic-password" class="form-label">Password</label>
            <input type="password" class="form-control" id="mechanic-password" name="password" placeholder="Password">
        </div>
        <div class="mb-3">
        </div>
        <button type="submit" class="btn btn-primary">Log in</button>
    </form>
    </div>
@endsection
