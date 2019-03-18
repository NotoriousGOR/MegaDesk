{{--
/*
 * File: c:\Users\dcheney\Documents\GitHub\project-falcon\Project-Falcon\resources\views\Pages\tickets\show.blade.php
 * Project: c:\Users\dcheney\Documents\GitHub\project-falcon\Project-Falcon
 * Created Date: Friday, January 11th 2019, 10:20:08 am
 * Author: Darrell Cheney
 * -----
 * Date Modified: 03/01/2019, 3:17:41
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
 * Date 	By	Comments
 * ----------	---	----------------------------------------------------------
 */ --}}

 @extends('layouts/app')

 @section('content')
        <div class="container-fluid">
            <a href="/queue">
                <button type="button" class="btn btn-info btn-circle mb-4" data-toggle="tooltip" data-placement="bottom" title="Back">
                    <i class="fas fa-arrow-left"></i>
                </button>
            </a>
            <link rel="stylesheet" href="{{asset('css/ticket.css')}}">
            <div id="container" class="container">
                <form method="POST" action="/tickets/{{$ticket->id}}">
                    @csrf
                    @method('PATCH')
                    <div class="form-group row mt-2">
                        <div class="form-group col-sm-3 text-center">
                            <label for="id" class="form-label">#</label>
                            <input class="form-control" id="id" value="{{$ticket->id}}" disabled>
                        </div>
                        <div class="form-group col-sm-3 text-center">
                            <label for="customername" class="form-label"> Customer Name</label>
                            <input class="form-control" id="customername" value="{{$ticket->CustomerName}}" disabled>
                        </div>
                        <div class="form-group col-sm-3 text-center">
                            <label for="extension" class="form-label">Ext.</label>
                            <input class="form-control" id="extension" value="{{$ticket->Extension}}" disabled>
                        </div>
                        <div class="form-group col-sm-3 text-center">
                            <label for="campusName" class="form-label">Campus</label>
                            <input class="form-control" id="campusName" value="{{$CampusName}}" disabled>
                        </div>
                        <div class="form-group col-sm-3 text-center">
                            <label for="room" class="form-label">Room</label>
                            <input class="form-control" id="room" value="{{$ticket->Room}}" disabled>
                        </div>

                        @if ($ticket->AssignedTo !== Auth::user()->id)
                            <div class="form-group col-sm-3 text-center">
                                <label for="assigned" class="form-label">Assigned To</label>
                                <input class="form-control" id="assigned" value="{{App\User::where('id',$ticket->AssignedTo)->value('name')}}" disabled>
                            </div>
                        @endif
                        <div class="form-group col-sm-3 text-center">
                            <label for="status" class="form-label">Ticket Status</label>
                            <select class="form-control text-center" id="status" name="TicketStatus" disabled>
                                <option @if ($ticket->TicketStatus == "New Issue")
                                            selected
                                        @endif value="Completed">New Issue</option>
                                <option @if ($ticket->TicketStatus == "In Progress")
                                            selected
                                        @endif value="In Progress">In Progress</option>
                                <option @if ($ticket->TicketStatus == "Out For Repair")
                                            selected
                                        @endif value="Out For Repair">Out For Repair</option>
                                <option @if ($ticket->TicketStatus == "Completed")
                                            selected
                                        @endif value="Completed">Completed</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-3 text-center">
                            <label for="birth" class="form-label">Created:</label>
                            <input class="form-control" id="birth" value="{{$ticket->created_at->format('F d, Y h:i a')}}" disabled>
                        </div>
                        <div class="form-group col-sm-3 text-center">
                            <label for="updated" class="form-label">Last updated:</label>
                            <input class="form-control" id="updated" value="{{$ticket->updated_at->format('F d, Y h:i a')}}" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="form-group col-sm-6">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="Description" id="description" class="form-control" disabled>{{$ticket->Description}}</textarea>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="comments" class="form-label">Comments</label>
                            <textarea name="Comments" id="comments" class="form-control" name="Comments" disabled>{{$ticket->Comments}}</textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            @if(Auth::user()->id == $ticket->AssignedTo)
                                <button id="ticketEdit" type="button" class="btn btn-info">
                                    <i class="fas fa-edit"></i> Edit Ticket
                                </button>
                            @endif
                        </div>
                        <div class="col">
                            <button id="printTicket" type="button" class="btn btn-mute float-right">
                                <i class="fas fa-print"></i> Print Ticket
                            </button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <button id="ticketEditSubmit" type="submit" class="btn btn-success d-none">
                                <i class="fas fa-check"></i> Apply Edit
                            </button>
                        </div>
                        <div class="col">
                            <button id="ticketEditCancel" type="button" class="btn btn-secondary float-right d-none">
                                <i class="fas fa-times"></i> Cancel Edit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        @push('scripts')
            <script>
                document.getElementById("ticketEdit").onclick = function() {
                    var editbtn = document.getElementById("ticketEdit");
                    var cancelbtn = document.getElementById("ticketEditCancel");
                    var submitbtn = document.getElementById("ticketEditSubmit");
                    var printbtn = document.getElementById("printTicket");

                    document.getElementById("status").disabled = false;
                    document.getElementById("comments").disabled = false;


                    editbtn.classList.toggle("d-none");
                    printbtn.classList.toggle("d-none");

                    cancelbtn.classList.toggle("d-none");
                    submitbtn.classList.toggle("d-none");


                }

                document.getElementById("printTicket").onclick = function() {
                    var win = window.open('/pdf/{{$ticket->id}}', '_blank');
                    win.focus();
                    };

                document.getElementById("ticketEditCancel").onclick = function() {

                    var editbtn = document.getElementById("ticketEdit");
                    var cancelbtn = document.getElementById("ticketEditCancel");
                    var submitbtn = document.getElementById("ticketEditSubmit");
                    var printbtn = document.getElementById("printTicket");

                    document.getElementById("status").disabled = true;
                    document.getElementById("comments").disabled = true;


                    editbtn.classList.toggle("d-none");
                    printbtn.classList.toggle("d-none");

                    cancelbtn.classList.toggle("d-none");
                    submitbtn.classList.toggle("d-none");

                }
            </script>
        @endpush
 @endsection
