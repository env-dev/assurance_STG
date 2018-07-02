@include('layout.inc.header')
<div class="page-wrapper">
    <div class="page-content--bge5">
        <div class="container">
            <div class="login-wrap">
                <div class="login-content">
                    <div class="login-logo">
                        <a href="#">
                            <img src="{{ asset('images/logo.png') }}" alt="STG TELECOM">
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
                                <label>Nom d'utilisateur</label>
                                <input class="au-input au-input--full" type="text" name="username" placeholder="Nom d'utilisateur" value="{{ old('username') }}" required>
                            </div>
                            <div class="form-group">
                                <label>Mot de passe</label>
                                <input class="au-input au-input--full" type="password" name="password" placeholder="Mot de passe" required>
                            </div>
                            <div class="login-checkbox">
                                <!--<label>
                                    <input type="checkbox" name="remember">Remember Me
                                </label>
                                <label>
                                    <a href="#">Forgotten Password?</a>
                                </label>-->
                            </div>
                            <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">Authentifié</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layout.inc.footer')
