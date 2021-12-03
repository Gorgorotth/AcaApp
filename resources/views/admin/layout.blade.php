<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Neon Admin Panel" />
    <meta name="author" content="" />

    <title>Admin</title>

    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">

    <link href="{{mix('css/app.css')}}" rel="stylesheet">

    <script src="/js/jquery-1.11.0.min.js"></script>
</head>
<body class="page-body {{$bodyClass ?? ''}}" style="height: revert">
@yield('content')
<x-session/>
<script src="{{mix('js/app.js')}}"></script>
</body>
</html>