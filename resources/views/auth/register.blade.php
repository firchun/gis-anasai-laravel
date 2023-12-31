@extends('layouts.auth')

@section('main-content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">{{ __('Register') }}</h1>
                                    </div>

                                    @if ($errors->any())
                                        <div class="alert alert-danger border-left-danger" role="alert">
                                            <ul class="pl-4 my-2">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <form method="POST" action="{{ route('register') }}" class="user">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                        <div class="form-group">
                                            <input type="text" class="form-control " name="name"
                                                placeholder="{{ __('Nama') }}" value="{{ old('name') }}" required
                                                autofocus>
                                        </div>

                                        <div class="form-group">
                                            <input type="text" class="form-control " name="phone"
                                                placeholder="{{ __('8xxx') }}" value="{{ old('phone') ?? '+62' }}"
                                                required>
                                            <small class="text-muted">Gunakan awalan +62 untuk menggantikan awalan 0 pada
                                                nomor anda</small>
                                        </div>

                                        <div class="form-group">
                                            <input type="email" class="form-control " name="email"
                                                placeholder="{{ __('E-Mail') }}" value="{{ old('email') }}" required>
                                            <small class="text-muted">Pastikan bahwa email aktif dan bisa mengirim
                                                email..</small>
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control " name="role">
                                                <option value="member" selected>Member (pengguna biasa)</option>
                                                <option value="seller">Penjual</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <input type="password" class="form-control " name="password"
                                                placeholder="{{ __('Password') }}" required>
                                            <small class="text-muted">Password minimal berisikan 8 karakter gabungan angka,
                                                huruf dan karakter lain</small>
                                        </div>

                                        <div class="form-group">
                                            <input type="password" class="form-control " name="password_confirmation"
                                                placeholder="{{ __('Confirm Password') }}" required>
                                            <small class="text-muted">Konfirmasi kembali password anda</small>
                                        </div>


                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                                {{ __('Register') }}
                                            </button>
                                        </div>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="{{ route('login') }}">
                                            {{ __('Already have an account? Login!') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
