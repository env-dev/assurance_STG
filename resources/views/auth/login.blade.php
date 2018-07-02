@include('layout.inc.header')
<div class="page-wrapper">
    <div class="page-content--bge5">
        <div class="container">
            <div class="login-wrap">
                <div class="login-content">
                    <div class="login-logo">
                        <a href="#">
                            <img src="{{ asset('images/logo.png') }}" alt="STG MAROC">
                        </a>
                    </div>
                    <div class="login-form">
                        @if($errors->has('username'))
                            <div class="alert alert-danger">
                                {{ $errors->first('username') }} 
                            </div>
                        @endif
                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Username</label>
                                <input class="au-input au-input--full" type="text" name="username" placeholder="{{ __('username') }}" value="{{ old('username') }}" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input class="au-input au-input--full" type="password" name="password" placeholder="{{ __('password') }}" required>
                            </div>
                            <div class="login-checkbox">
                                <!--<label>
                                    <input type="checkbox" name="remember">Remember Me
                                </label>
                                <label>
                                    <a href="#">Forgotten Password?</a>
                                </label>-->
                            </div>
                            <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">sign in</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layout.inc.footer')
