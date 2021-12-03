@extends('admin.layout', ['bodyClass' => 'page-fade-only'])
@section('content')
    <div class="page-container">
        <div class="sidebar-menu">
            <header class="logo-env" style="">
                <!-- logo -->
                <div class="logo" style="">
                    <a href="#">
                        <img src="/images/logo@2x.png" width="120" alt="">
                    </a>
                </div>
                <!-- logo collapse icon -->
                <div class="sidebar-collapse" style="">
                    <a href="#" class="sidebar-collapse-icon with-animation">
                        <i class="entypo-menu"></i>
                    </a>
                </div>
                <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
                <div class="sidebar-mobile-menu visible-xs">
                    <a href="#" class="with-animation">
                        <i class="entypo-menu"></i>
                    </a>
                </div>

            </header>
            <ul id="main-menu" class="" style="">
                <!-- add class "multiple-expanded" to allow multiple submenus to open -->
                <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
                <!-- Search Bar -->
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
                    <a href="{{route('admin.dashboard')}}" {{--target="_blank--}}>
                        <i class="entypo-monitor"></i>
                        <span style="">Dashboard</span>
                    </a>
                </li>

                <li class="root-level has-sub">
                    <a href="#">
                        <i class="entypo-tools"></i>
                        <span style="">Garage</span>
                    </a>
                    <ul style="">
                        <li>
                            <a href="{{route('admin.garage.index')}}">
                                <i class="entypo-list"></i>
                                <span style="">Garage List</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('admin.garage.create')}}">
                                <i class="entypo-plus-circled"></i>
                                <span style="">Create Garage</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="root-level has-sub">
                    <a href="#">
                        <i class="entypo-briefcase"></i>
                        <span style="">Mechanic</span>
                        {{--                        <span class="badge badge-secondary" style="">8</span>--}}
                    </a>
                    <ul style="">
                        <li>
                            <a href="{{route('admin.mechanic.index')}}">
                                <i class="entypo-list"></i>
                                <span style="">Mechanic List</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('admin.mechanic.create')}}">
                                <i class="entypo-user-add"></i>
                                <span style="">Create Mechanic</span>
                            </a>
                        </li>
                    </ul>
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
                        <a href="{{route('admin.logout')}}">
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