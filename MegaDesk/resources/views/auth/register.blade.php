@extends('layouts.app')

@section('content')

@auth
    @can('administrator', auth()->user())
    <div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <img class="modal-title w-10 img-fluid form-img" src="{{asset('svg/MegaDeskLogo.svg')}}" alt="logo" />
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-4 login-input">
                            <i class="fas fa-user"></i>
                            <input id="name" type="text" placeholder = "John Doe"
                            class="p-3 login-input user-input" name="name"
                            value="{{ old('name') }}"
                            required autofocus>
                        </div>

                        <div class="row mb-4 login-input">
                            <i class="fas fa-envelope"></i>
                            <input id="email" type="email"
                            class="p-3 login-input user-input"
                            name="email"
                            placeholder="John.Doe@cvisd.org"
                            value="{{ old('email') }}"
                            required>
                        </div>

                        <div class="row mb-4 login-input">
                            <i class="fas fa-2x fa-lock"></i>
                            <input id="password" type="password" class="p-3 login-input user-input" name="password" placeholder="Password"
                            required>
                        </div>

                        <div class="row mb-4 login-input">
                            <i class="fas fa-2x fa-lock"></i>
                            <input id="password-confirm" type="password" class="p-3 login-input user-input" name="password_confirmation"
                            placeholder="Password Confirm" required>
                        </div>

                        <div class="modal-footer d-flex justify-content-center">
                            <button id="register-btn" type="submit" class="pl-5 pr-5 btn btn-primary">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endcan
@endauth

@if(Auth::user()->authLvl > 1)
    <script>
        window.location.href='/login';
    </script>
@endif

@endsection
