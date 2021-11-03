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
<ul class="nav nav-pills justify-content-between border-bottom mt-2 pb-2">
    <li class="nav-item"><a href="{{route('mechanic.dashboard')}}" class="nav-link">Dashboard</a></li>
    <li class="nav-item"><a href="{{route('mechanic.createInvoice')}}" class="nav-link">Create Invoice</a></li>
    <li class="nav-item"><a href="#" class="nav-link">Edit Profile</a></li>
    <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
    <li class="nav-item"><a href="{{route('mechanic.logout')}}" class="nav-link">Log Out</a></li>
</ul>

@endauth
@yield('content')
{{--<x-session/>--}}

<script src="{{mix('js/app.js')}}"></script>

</body>
</html>