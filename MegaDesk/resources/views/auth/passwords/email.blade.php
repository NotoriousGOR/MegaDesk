@extends('layouts.app')

@section('content')
<div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <img class="modal-title w-10 img-fluid form-img" src="{{asset('svg/MegaDeskLogo.svg')}}" alt="logo" />
            </div>
            <div class="modal-body mx-3">
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <h1 class="text-center mb-2">Login</h1>
                    <div class="row mb-4 login-input">
                        <i class="fas fa-envelope"></i>
                        <input id="email" type="email" placeholder="Your email" class="p-3 login-input user-input" name="email" value="{{ old('email') }}"
                            required autofocus>
                    </div>

                    <div class="modal-footer d-flex justify-content-center">
                        <button id="login-btn" type="submit" class="btn btn-primary pl-5 pr-5">
                            {{ __('Send Reset Link') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
