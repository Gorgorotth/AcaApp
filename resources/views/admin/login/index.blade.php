@extends('admin.layout', ['bodyClass' => 'login-page login-form-fall login-form-fall-init'])
@section('content')
    <div class="login-container">
        <div class="login-header login-caret">
            <div class="login-content">
                <a href="index.html" class="logo">
                    <img src="images/logo@2x.png" width="120" alt=""/>
                </a>
                <p class="description">Dear admin, log in to access the admin area!</p>
            </div>
        </div>
        <div class="login-form">
            <div class="login-content">
                <form method="post" action="{{route('admin.login')}}" role="form" id="form_login">
                    @csrf
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="entypo-user"></i>
                            </div>
                            <input type="text" class="form-control" name="email" id="email" placeholder="Email"
                                   autocomplete="off"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="entypo-key"></i>
                            </div>
                            <input type="password" class="form-control" name="password" id="password"
                                   placeholder="Password" autocomplete="off"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block btn-login">
                            <i class="entypo-login"></i>
                            Login In
                        </button>
                    </div>
                </form>
                <div class="login-bottom-links">
                    <a href="extra-forgot-password.html" class="link">Forgot your password?</a>
                    <br/>
                    <a href="#">ToS</a> - <a href="#">Privacy Policy</a>
                </div>
            </div>
        </div>
    </div>
@endsection