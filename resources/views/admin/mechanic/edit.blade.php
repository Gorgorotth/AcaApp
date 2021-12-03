@extends('admin.sidebar')
@section('main-content')
    <div class="page-title">
        <h2>Edit Mechanic</h2>
    </div>

    <form class="my-4" method="post" action="{{route('admin.mechanic.update', ['mechanic' => $mechanic->id])}}">
        @method('put')
        @csrf
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
                    <label for="name" class="col-sm-2 col-form-label">Name:</label>
                    <div class="col-sm-9">
                        <input type="text" name="name" class="form-control" id="name"
                               value="{{$mechanic['name']}}">
                    </div>
                </div>
                <div class="row form-group">
                    <label for="email" class="col-sm-2 col-form-label">Email:</label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control" name="email" id="email"
                               value="{{$mechanic['email']}}">
                    </div>
                </div>
                <div class="row form-group">
                    <label for="garage" class="col-sm-2 col-form-label">Garage:</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="garageId" id="garage">
                            <option value="-1">None</option>
                            @foreach($garages as $garage)
                                <option {{$garage == $mechanic->garage ? 'selected' : ''}} value="{{$garage->id}}">{{$garage->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="text-center">
                    <button class="btn btn-primary">Edit</button>
                </div>
            </div>
        </div>
    </form>
@endsection