{{--
/*
 * File: c:\Users\grosales\Documents\project-falcon\Project-Falcon\resources\views\users\show.blade.php
 * Project: c:\Users\grosales\Documents\project-falcon\Project-Falcon
 * Created Date: Tuesday, January 22nd 2019, 2:37:17 pm
 * Author: Gabriel Rosales
 * -----
 * Date Modified: 02/25/2019, 1:47:02
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

@extends('layouts/app')
    @section('content')
        @php
            $chartType = 'pie';
        @endphp

        <div class="container">
            <link rel="stylesheet" href="{{asset('css/user.css')}}">
            <chart-component
            :dataset= {{json_encode($avgArray)}}
            :mylabels= {{json_encode($campusNames)}}
            :chart= {{json_encode($chartType)}}>
            </chart-component>
            <div class="container">
                <form method="POST" action="/users/{{$user->id}}">
                    @csrf
                    @method('PATCH')
                    <div class="form-group row">
                        <div class="col">
                            <label for="name" class="form-label">Name</label>
                            <input class="form-control {{$errors->has('name') ? 'error-found' : ''}}" name="name" id="name" placeholder="Name" value="{{$user->name}}" disabled>
                        </div>
                        <div class="col">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="{{$errors->has('email') ? 'error-found' : ''}} form-control" id="email" name="email" placeholder="Email" value="{{$user->email}}" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <label for="auth" class="form-label">Authorization Level</label>
                            <select class="form-control {{$errors->has('authLevel') ? 'error-found' : ''}}" id="auth" name="authLevel" disabled>
                                <option @if ($user->authLvl == 1)
                                            selected
                                        @endif value="1">Administrator</option>
                                <option @if ($user->authLvl == 2)
                                            selected
                                        @endif value="2">Call Center</option>
                                <option @if ($user->authLvl == 3)
                                            selected
                                        @endif value="3">Technician</option>
                            </select>
                        </div>
                        <div class="col">
                            <label for="campuses" class="form-label">Assigned Campuses</label>
                            <select id="campuses" class="{{$errors->has('campuses[]') ? 'error-found' : ''}} custom-select" multiple size="5" name="campuses[]" disabled>
                                @foreach ($allCampuses as $campus)
                                    <option value="{{$campus->id}}"
                                        @if ($campus->TechID == $user->id)
                                            selected
                                        @endif>
                                        {{$campus->CampusName}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @if (Gate::allows('administrator'))
                    <div class="row">
                        <div class="col">
                            <button id="userEdit" type="button" class="btn btn-dark">
                                <i class="fas fa-user-edit"></i> Edit User
                            </button>
                        </div>
                        @if (auth()->user()->id !== $user->id)
                            <div class="col">
                                <button id="userDelete" type="button" class="btn btn-danger float-right">
                                    <i class="fas fa-user-minus"></i> Delete User
                                </button>
                            </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col">
                            <button id="userEditSubmit" type="submit" class="btn btn-success d-none">
                                <i class="fas fa-check"></i> Apply Edit
                            </button>
                        </div>
                        <div class="col">
                            <button id="userEditCancel" type="button" class="btn btn-warning float-right d-none">
                                <i class="fas fa-times"></i> Cancel Edit
                            </button>
                        </div>
                    </div>
                    @endif
                </form>
            </div>
        </div>

        @if (Gate::allows('administrator') && auth()->user()->id !== $user->id)
            <div class="modal fade" id="userDeleteModal" tabindex="-1" role="dialog" aria-labelledby="User Delete Modal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-center">Delete User</h5>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete user: <strong>{{$user->name}}</strong>?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                            <button id="confirmedDelete" type="button" class="btn btn-danger">Confirm Delete</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="passwordConfirm" tabindex="-1" role="dialog" aria-labelledby="User Delete Modal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="dialog">
                    <div class="modal-content">
                        <form action="/users/{{$user->id}}" method="post">
                            @csrf @method('DELETE')
                            <div class="modal-header">
                                <h5 class="modal-title">Confirm Password</h5>
                            </div>
                            <div class="modal-body">
                                <div class="row login-input">
                                    <i class="fas fa-2x fa-lock"></i>
                                    <input id="password-confirm" type="password" class="p-3 login-input user-input" name="password" placeholder="Password Confirm"
                                    required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-danger">Confirm Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif

        @if (Gate::allows('administrator') && auth()->user()->id == $user->id)
            @push('scripts')
                    <script>
                        console.log('true');
                        document.getElementById("userEdit").onclick = function() {
                            var editbtn = document.getElementById("userEdit");
                            var cancelbtn = document.getElementById("userEditCancel");
                            var submitbtn = document.getElementById("userEditSubmit");

                            document.getElementById("name").disabled = false;
                            document.getElementById("email").disabled = false;
                            document.getElementById("auth").disabled = false;
                            document.getElementById("campuses").disabled = false;

                            editbtn.classList.toggle("d-none");

                            cancelbtn.classList.toggle("d-none");
                            submitbtn.classList.toggle("d-none");

                        }

                        document.getElementById("userEditCancel").onclick = function() {
                            var editbtn = document.getElementById("userEdit");
                            var cancelbtn = document.getElementById("userEditCancel");
                            var submitbtn = document.getElementById("userEditSubmit");

                            document.getElementById("name").disabled = true;
                            document.getElementById("email").disabled = true;
                            document.getElementById("auth").disabled = true;
                            document.getElementById("campuses").disabled = true;

                            editbtn.classList.toggle("d-none");

                            cancelbtn.classList.toggle("d-none");
                            submitbtn.classList.toggle("d-none");

                        }
                    </script>
                @endpush
            @elseif(Gate::allows('administrator') && auth()->user()->id !== $user->id)
                @push('scripts')
                    <script>
                        document.getElementById("userEdit").onclick = function() {
                            var deletebtn = document.getElementById("userDelete");
                            var editbtn = document.getElementById("userEdit");
                            var cancelbtn = document.getElementById("userEditCancel");
                            var submitbtn = document.getElementById("userEditSubmit");

                            document.getElementById("name").disabled = false;
                            document.getElementById("email").disabled = false;
                            document.getElementById("auth").disabled = false;
                            document.getElementById("campuses").disabled = false;

                            deletebtn.classList.toggle("d-none");
                            editbtn.classList.toggle("d-none");

                            cancelbtn.classList.toggle("d-none");
                            submitbtn.classList.toggle("d-none");

                        }

                        document.getElementById("userEditCancel").onclick = function() {
                            var deletebtn = document.getElementById("userDelete");
                            var editbtn = document.getElementById("userEdit");
                            var cancelbtn = document.getElementById("userEditCancel");
                            var submitbtn = document.getElementById("userEditSubmit");

                            document.getElementById("name").disabled = true;
                            document.getElementById("email").disabled = true;
                            document.getElementById("auth").disabled = true;
                            document.getElementById("campuses").disabled = true;

                            deletebtn.classList.toggle("d-none");
                            editbtn.classList.toggle("d-none");

                            cancelbtn.classList.toggle("d-none");
                            submitbtn.classList.toggle("d-none");

                        }
                        $('#userDelete').on('click', function() {
                            $('#userDeleteModal').modal('show');
                        });

                        $('#confirmedDelete').on('click', function() {
                            $('#userDeleteModal').modal('hide');
                            $('#passwordConfirm').modal('show');
                        });
                    </script>
                @endpush
        @endif
    @endsection
