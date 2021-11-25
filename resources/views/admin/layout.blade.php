<!doctype html>
<html>
<head>
    <title>Invoices</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="{{mix('css/app.css')}}" rel="stylesheet">

</head>
<body>
@auth()
    <header class="border-bottom">
        <div class="container">
            <ul class="nav nav-pills justify-content-between  py-2">
                <li class="nav-item"><a href="{{route('admin.dashboard')}}" class="nav-link">Dashboard</a></li>
                <li>
                    <div class="btn-group dropend">
                        <button type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown"
                                aria-expanded="false">
                            Garage
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="{{route('admin.garage.create')}}" class="dropdown-item">Create</a></li>
                            <li><a href="{{route('admin.garage.index')}}" class="dropdown-item">Dashboard</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <div class="btn-group dropstart">
                        <button type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown"
                                aria-expanded="false">
                            Mechanic
                        </button>
                        <ul class="dropdown-menu text-end">
                            <li><a href="{{route('admin.mechanic.create')}}" class="dropdown-item">Create</a></li>
                            <li><a href="{{route('admin.mechanic.index')}}" class="dropdown-item">Dashboard</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item"><a href="{{route('admin.logout')}}" class="nav-link">Log Out</a></li>
            </ul>
        </div>
    </header>
@endauth
@yield('content')
<x-session/>
<script src="{{mix('js/app.js')}}"></script>
</body>
</html>