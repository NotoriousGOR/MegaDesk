@extends('layouts.app')
@section('content')
<div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <img class="modal-title w-10 img-fluid form-img" src="{{asset('svg/MegaDeskLogo.svg')}}" alt="logo" />
            </div>
            <div class="modal-body mx-3">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <h1 class="text-center mb-2">Login</h1>
                    <div class="row mb-4 login-input">
                        <i class="fas fa-envelope"></i>
                        <input id="email"
                        type="email"
                        placeholder="Your email"
                        class="p-3 login-input user-input"
                        name="email"
                        value="{{ old('email') }}"
                        required autofocus>
                    </div>

                    <div class="row mb-4 d-flex login-input">
                        <i class="fas fa-2x fa-lock"></i>
                        <input id="password"
                        placeholder="Your password"
                        type="password"
                        class="p-3 login-input user-input"
                        name="password" required>
                    </div>

                    <div class="modal-footer d-flex justify-content-center">
                        @if (Route::has('password.request'))
                            <div class="col">
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                                </a>
                            </div>
                        @endif
                        <button id="login-btn" type="submit" class="btn btn-success pl-5 pr-5">
                            {{ __('Login') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
