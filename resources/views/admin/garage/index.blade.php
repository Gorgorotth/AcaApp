@extends('admin.layout')
@section('content')
    <div class="container">
        <div class="list-group">
            <div class="d-flex justify-content-between my-4">
                <form method="get" action="{{route('admin.garage.index')}}"
                      class="d-flex justify-content-between align-content-center col-sm-11">
                    <div class="d-flex justify-content-between">
                        <input class="form-control me-2" type="text" name="search" placeholder="Search"
                               aria-label="Search"
                               value="{{request('search')}}">
                        <button class="btn btn-outline-primary" type="submit">Search</button>
                    </div>
                </form>
                <form method="get" action="{{route('admin.garage.index')}}" class="col-sm-2">
                    <div class="end-50">
                        <input type="hidden" name="sortByCreatedDate" value="{{$orderBy}}">

                        <input hidden name="search" placeholder="Search" aria-label="Search"
                               value="{{request('search')}}">
                        <button class="text-start btn btn-primary" type="submit">Sort by date</button>
                    </div>
                </form>
            </div>
            <div class="container">
                <div class="row mt-3">
                    <table class="table table-bordered">
                        <thead>
                        <tr class="text-center">
                            <th class="col-md-2">
                                Date
                            </th>

                            <th class="col-md-3">
                                Garage Name
                            </th>
                            <th class="col-md-3">
                                Garage Address
                            </th>
                            <th class="col-md-2">
                                Edit Garage
                            </th>
                            <th class="col-md-2">
                                Delete Garage
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($garages as $key => $garage)
                            <tr class="text-center">
                                <th>
                                    {{$garage['created_at']}}
                                </th>
                                <th>
                                    {{$garage['name']}}
                                </th>
                                <th>
                                    {{$garage['address']}}
                                </th>
                                <th>
                                    <a href="{{route('admin.garage.edit', ['garage' => $garage['id']])}}"
                                       class="btn btn-outline-primary">Edit</a>
                                </th>
                                <th>
                                    <div>
                                        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{$key}}">Delete
                                        </button>
                                        @include('admin.garage.templates.delete-garage-template')
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