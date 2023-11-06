<!-- Login Form -->

<form method="POST" action="{{ route('login') }}" class="user">
    {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> --}}
    @csrf
    <div class="login-form">
        <div class="login-top">
            <span class="close">&times;</span>
        </div>
        <div class="login">
            <h3 class="text-center">
                Bavel Log In
            </h3>
            <div class="form-input">
                <label>Email</label> <br>
                <input type="email" name="email" class="form-control">
            </div>
            <div class="form-input">
                <label>Password</label> <br>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="form-input">
                <button type="submit" class="btn btn-login">Log In</button>
            </div>
            <a href="{{ route('register') }}" class="text-center" style="font-size: unset;">Don't have account ?
                Register now</a>
            <a href="{{ route('password.request') }}" class="text-center" style="font-size: unset;">Forgot Password?</a>
        </div>
    </div>
</form>

<div class="login-overlay"></div>
