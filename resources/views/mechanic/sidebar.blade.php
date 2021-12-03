@extends('mechanic.layout', ['bodyClass' => 'page-fade-only'])
@section('content')
    <div class="page-container">
        <div class="sidebar-menu">
            <header class="logo-env" style="">
                <div class="logo" style="">
                    <a href="#">
                        <img src="/images/logo@2x.png" width="120" alt="">
                    </a>
                </div>
                <div class="sidebar-collapse" style="">
                    <a href="#" class="sidebar-collapse-icon with-animation">
                        <i class="entypo-menu"></i>
                    </a>
                </div>
                <div class="sidebar-mobile-menu visible-xs">
                    <a href="#" class="with-animation">
                        <i class="entypo-menu"></i>
                    </a>
                </div>

            </header>
            <ul id="main-menu" class="" style="">
                <li id="search" class="root-level">
                    <form method="get" action="{{$searchRoute ?? '#'}}">
                        <input {{$attribute ?? ''}} type="text" name="search" class="search-input"
                               placeholder="Search something..." style=""
                               value="{{$searchRequest ?? ''}}">
                        <button type="submit" style="">
                            <i class="entypo-search"></i>
                        </button>
                    </form>
                </li>
                <li class="root-level">
                    <a href="{{route('mechanic.dashboard')}}">
                        <i class="entypo-monitor"></i>
                        <span style="">Dashboard</span>
                    </a>
                </li>
                <li class="root-level">
                    <a href="{{route('mechanic.createInvoice')}}">
                        <i class="entypo-pencil"></i>
                        <span style="">Create Invoice</span>
                    </a>
                </li>
                <li class="root-level">
                    <a href="{{route('mechanic.edit-mechanic')}}">
                        <i class="entypo-cog"></i>
                        <span style="">Edit profile</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="main-content" style="padding-bottom: 25%;">
            <div class="row">
                <div class="col-md-6 col-sm-8 clearfix">
                    <ul class="user-info pull-left pull-none-xsm">
                        <img src="/images/thumb-1@2x.png" alt="Admin Pic:" class="img-circle" width="44">
                        {{auth()->user()->name}}
                    </ul>
                </div>
                <div class="col-md-6 col-sm-4 clearfix">
                    <ul class="user-info pull-right pull-none-xsm">
                        <a href="{{route('mechanic.logout')}}">
                            Log Out <i class="entypo-logout right"></i>
                        </a>
                    </ul>
                </div>
            </div>
            <hr>
            @yield('main-content')
        </div>
    </div>
@endsection