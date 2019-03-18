{{--
/*
 * File: c:\Users\grosales\Documents\project-falcon\Project-Falcon\resources\views\users\index.blade.php
 * Project: c:\Users\grosales\Documents\project-falcon\Project-Falcon
 * Created Date: Tuesday, January 22nd 2019, 2:37:03 pm
 * Author: Gabriel Rosales
 * -----
 * Date Modified: 02/20/2019, 2:28:32
 * Modified By: Gabriel Rosales
 * -----
 * Copyright (c) 2019 Avuncular Digital
 * MIT License
 *
 * Copyright (c) 2019 Avuncular Digital
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of
 * this software and associated documentation files (the "Software"), to deal in
 * the Software without restriction, including without limitation the rights to
 * use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies
 * of the Software, and to permit persons to whom the Software is furnished to do
 * so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 * -----
 * HISTORY:
 * Date      	By	Comments
 * ----------	---	----------------------------------------------------------
 */
 --}}


@extends('layouts.app')

@section('content')

@auth
    @can('administrator', auth()->user())
    <link rel="stylesheet" href="{{asset('css/Users.css')}}">
    <div class="container">
        <div class="table-responsive">
            <table class="table table-light table-hover text-center table-striped">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Authorization</th>
                        <th scope="col">Campuses</th>
                        <th scope="col">Last Login</th>
                        <th scope="col"># Of Open Tickets</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td class="p-4">
                            <a href="users/{{$user->id}}">{{$user->name}}</a>
                        </td>
                        <td class="p-4">
                            {{$user->email}}
                        </td>
                        <td class="p-4">
                            @switch($user->authLvl) 
                                @case(1) Administrator 
                                    @break 
                                @case(2) Call Center 
                                    @break 
                                @default Technician 
                            @endswitch
                        </td>
                        <td class="p-4">
                            {{trim($user->campuses->implode('CampusName', ', '))}}
                        </td>
                        @if($user->updated_at == null )
                            <td class="p-4">
                
                            </td>
                        @else
                            <td class="p-4">
                                {{$user->updated_at->format('m/d/y h:i a')}}
                            </td>
                        @endif
                            <td class="p-4">
                                {{$user->tickets->where('TicketStatus', '!=', 'Completed')->count()}}
                            </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <span class="mt-4 float-center shadow-lg">{{$users->links()}}</span>
            <button id="addUser" class="btn btn-info float-left pl-4 pr-4 shadow mt-4" data-toggle="tooltip" data-placement="right" title="Add User">
                <i class="fas fa-user-plus"></i>
            </button>
           
    </div>

    {{-- New User modal --}}
    <div class="modal fade" id="modalNewUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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



@push('scripts')
    @if(Auth::user()->authLvl > 1)
    <script>
        window.location.href='/login';
    </script>
    @endif

    <script>
        $('#addUser').on('click', function() {
            $('#modalNewUser').modal('show');
        });
    </script>
@endpush

@endsection
