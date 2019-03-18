{{--
/*
 * File: c:\Users\grosales\Documents\project-falcon\Project-Falcon\resources\views\Pages\Search.blade.php
 * Project: c:\Users\grosales\Documents\project-falcon\Project-Falcon
 * Created Date: Wednesday, December 5th 2018, 8:37:27 am
 * Author: Gabriel Rosales
 * -----
 * Date Modified: 02/26/2019, 1:32:10
 * Modified By: Gabriel Rosales
 * -----
 * Copyright (c) 2018 Avuncular Digital
 * MIT License
 *
 * Copyright (c) 2018 Avuncular Digital
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
        <div class="container-fluid d-flex flex-row justify-content-around align-items-stretch flex-wrap">
            <div class="card rounded p-3 m-3 shadow-lg">
                <div class="card-body">
                    <form method="GET" action="/search/">
                        @csrf
                        <div class="form-row mb-4">
                            <div class="col">
                                <input name="first" type="text" class="form-control mx-auto shadow-sm {{$errors->has('first') ? 'border-danger' : ''}}" placeholder="First" value="{{ Request::old('first') }}">
                            </div>
                            <div class="col">
                                <input name="last" type="text" class="form-control mx-auto shadow-sm {{$errors->has('last') ? 'border-danger' : ''}}" placeholder="Last" value="{{ Request::old('last') }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <p>Ticket Info</p>
                        </div>
                        <div class="form-row mb-4">
                            <div class="col">
                                <select id="status" name="status[]" class="form-control shadow-sm {{$errors->has('status[]') ? 'border-danger' : ''}}" size="2" multiple>
                                    <option value="New Issue">New Issue</option>
                                    <option value="In Progress">In Progress</option>
                                    <option value="Out For Repair">Out For Repair</option>
                                    <option value="Completed">Completed</option>
                                </select>
                            </div>
                            <div class="col">
                                <input id="ticketID" name="ticketID" type="text" class="form-control mx-auto shadow-sm {{$errors->has('ticketID') ? 'border-danger' : ''}}" placeholder="Ticket ID" value="{{ Request::old('ticketID') }}">
                            </div>
                        </div>
                        <div class="form-row mb-4">
                            <label for="status">User</label>
                            <select id="" name="users[]" class="form-control shadow-sm {{$errors->has('users[]') ? 'border-danger' : ''}}" multiple size="2">
                                @foreach ($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-row mb-4">
                            <label for="campuses" class="control-label">Campus</label>
                            <select id="campuses" name="campuses[]" class="form-control shadow-sm {{$errors->has('campuses[]') ? 'border-danger' : ''}}" multiple size="2">
                                @foreach ($campuses as $campus)
                            <option value="{{$campus->id}}">{{$campus->CampusName}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-row mb-4">
                            <div class="col">
                                <label for="room" class="control-label">Room Number</label>
                                <input id="room" name="room" type="text" class="form-control {{$errors->has('room') ? 'border-danger' : ''}}" placeholder="Room">
                            </div>
                            <div class="col">
                                <label for="ext" class="control-label">Extension</label>
                                <input id="ext" name="ext" type="text" class="form-control shadow-sm {{$errors->has('ext') ? 'border-danger' : ''}}" placeholder="Ext." value="{{ Request::old('ext') }}">
                            </div>

                        </div>
                        <div class="form-row mt-4">
                            <div class="col">
                                <label for="from-date" class="control-label">From Date</label>
                                <input name="fromDate" class="form-control shadow-sm {{$errors->has('fromDate') ? 'border-danger' : ''}}" type="date" value="" id="from-date">
                            </div>

                            <div class="col">
                                <label for="to-date" class="control-label">To Date</label>
                                <input id="to-date" name="toDate" class="form-control shadow-sm" type="date" value="{{$today}}">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success mt-4 shadow"> <i class="fas fa-search"></i> Search</button>
                    </form>
                </div>
            </div>

            @if (count($results) > 0)
            <div class="card shadow-lg m-3 border-0">
                <div id="results" class="card-body d-flex flex-column">
                    @foreach ($results as $result)
                        <div id="result" class="card shadow mb-3">
                            <div class="card-body text-center">
                                <div class="row mt-2">
                                    <div class="col-sm-3 mb-3">
                                        <i class="fas fa-hashtag icons"></i>
                                        <h5 class="form-control"><a href="/tickets/{{$result->id}}">{{$result->id}}</a></h5>
                                    </div>
                                    <div class="col-sm-3 mb-3">
                                        <i class="fas fa-calendar-day icons"></i>
                                        <input class="form-control text-center" id="id" value="{{$result->created_at->format('m/d/y h:i a')}}" disabled>
                                    </div>
                                    <div class="col-sm-3 mb-3">
                                        <i class="fas fa-concierge-bell icons"></i>
                                        <input class="form-control text-center" id="id" value="{{$result->CustomerName}}" disabled>
                                    </div>
                                    <div class="col-sm-3 mb-3">
                                        <i class="fas fa-user icons"></i>
                                        <input class="form-control text-center" id="id" value="{{App\User::where('id',$result->AssignedTo)->value('name')}}" disabled>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3 mb-3">
                                        <i class="fas fa-clipboard-check icons"></i>
                                        <input class="form-control text-center" id="id" value="{{$result->TicketStatus}}" disabled>
                                    </div>
                                    <div class="col-sm-3 mb-3">
                                        <i class="fas fa-school icons"></i>
                                        <input class="form-control text-center" id="id" value="{{App\Campus::where('id',$result->CampusID)->value('CampusName')}}" disabled>
                                    </div>
                                    <div class="col-sm-3 mb-3">
                                        <i class="fas fa-door-closed icons"></i>
                                        <input class="form-control text-center" id="id" value="{{$result->Room}}" disabled>
                                    </div>
                                    <div class="col-sm-3 mb-3">
                                        <i class="fas fa-phone icons"></i>
                                        <input class="form-control text-center" id="id" value="{{$result->Extension}}" disabled>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 mt-2">
                                        <label for="comments">Comments</label>
                                        <textarea class=" form-control" id="comments" readonly>{{$result->Comments}}</textarea>
                                    </div>
                                    <div class="col-sm-6 mt-2">
                                        <label for="description">Description</label>
                                        <textarea class=" form-control" id="description" readonly>{{$result->Description}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
@endsection
