@extends('admin.sidebar')
@section('main-content')
    <div class="row page-title">
        <h2 class="col-md-6">Mechanics</h2>
        <div class="page-title-controls col-md-6">
            <form method="get" action="{{route('admin.mechanic.index')}}"
                  class="col-sm-8">
                <div class="row">
                    <div class="col-sm-8">
                        <input class="form-control" type="text" name="search" placeholder="Search"
                               aria-label="Search"
                               value="{{request('search')}}">
                    </div>
                    <div class="col-sm-1">
                        <button class="btn btn-green" type="submit">
                            <i class="entypo-search">Search</i>
                        </button>
                    </div>
                </div>
            </form>
            <form method="get" action="{{route('admin.mechanic.index')}}" class="col-sm-4">
                <div class="end-50">
                    <input type="hidden" name="sortByCreatedDate" value="{{$orderBy}}">

                    <input hidden name="search" placeholder="Search" aria-label="Search"
                           value="{{request('search')}}">
                    <button class="text-start btn btn-primary" type="submit">Sort by date</button>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
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
                        <th class="text-center">
                            <a href="{{route('admin.mechanic.edit', ['mechanic' => $mechanic['id']])}}"
                               class="btn btn-info btn-sm">
                                <i class="entypo-cog">Edit</i>
                            </a>
                        </th>
                        <th>
                            <div class="text-center">
                                <button type="button" class="btn btn-orange btn-sm"
                                        onclick="$('#deleteModal{{$key}}').modal('show', {backdrop: 'static'});">
                                    <i class="entypo-trash">Delete</i>
                                </button>
                                @include('admin.mechanic.templates.delete-mechanic-template')
                            </div>
                        </th>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection