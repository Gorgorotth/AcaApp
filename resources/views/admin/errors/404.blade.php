@extends('admin.layout')
@section('content')
    <div class="container d-flex justify-content-center">
        <div class="row">
            <div class="col-md-12">
                <div class="text-center">
                    <h1>
                        Oops!</h1>
                    <h2>
                        404 Not Found</h2>
                    <div>
                        Sorry, an error has occurred, Requested page not found!
                    </div>
                    <div class="text-center">
                        <a href="{{route('admin.home')}}" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-home"></span>
                            Take Me Home
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection