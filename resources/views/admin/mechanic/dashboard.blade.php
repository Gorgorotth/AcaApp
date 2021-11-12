@extends('admin.layout')
@section('content')
    <div class="container">
        <div class="list-group">
            {{--            <div class="row justify-content-between my-4">--}}
            {{--                <form method="get" action="{{route('admin.dashboard')}}" class="d-flex col-sm-4">--}}
            {{--                    <input class="form-control me-2" type="text" name="search" placeholder="Search" aria-label="Search"--}}
            {{--                           value="{{request('search')}}">--}}
            {{--                    <button class="btn btn-outline-primary" type="submit">Search</button>--}}
            {{--                </form>--}}
            {{--                <form method="get" action="{{route('admin.dashboard')}}" class="col-sm-2">--}}
            {{--                    <button class="btn btn-primary" value="{{$orderBy}}" name="sortByCreatedDate" type="submit">Sort by--}}
            {{--                        date--}}
            {{--                    </button>--}}
            {{--                </form>--}}
            {{--            </div>--}}
            <div class="container">
                <div class="row mt-3">
                    <table class="table table-bordered">
                        <thead>
                        <tr class="text-center">
                            <th class="col-md-2">
                                Date
                            </th>

                            <th class="col-md-3">
                                Mechanic Name
                            </th>
                            <th class="col-md-3">
                                Mechanic Email
                            </th>
                            <th class="col-md-2">
                                Edit Mechanic
                            </th>
                            <th class="col-md-2">
                                Delete Mechanic
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($mechanics as $key => $mechanic)
                            <tr class="text-center">
                                <th>
                                    {{$mechanic['created_at']}}
                                </th>
                                <th>
                                    {{$mechanic['name']}}
                                </th>
                                <th>
                                    {{$mechanic['email']}}
                                </th>
                                <th>
                                    <a href="{{route('admin.edit-mechanic', ['mechanicId' => $mechanic['id']])}}" class="btn btn-outline-primary">Edit</a>
                                </th>
                                <th>
                                    <div>
                                        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{$key}}">Delete
                                        </button>
                                        @include('admin.templates.delete-mechanic-template')
                                    </div>
                                </th>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection