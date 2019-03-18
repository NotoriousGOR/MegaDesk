{{--
/*
 * File: c:\Users\grosales\Documents\project-falcon\Project-Falcon\resources\views\Pages\Queue.blade.php
 * Project: c:\Users\grosales\Documents\project-falcon\Project-Falcon
 * Created Date: Wednesday, December 5th 2018, 8:37:13 am
 * Author: Gabriel Rosales
 * -----
 * Date Modified: 03/18/2019, 8:27:31
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
    <div class="container-fluid d-flex align-content-center ">
        @if(count($tickets) >= 1)
        <div class="table-responsive p-4">
            <table class="table table-light table-striped table-hover text-center shadow">
                <thead>
                    <tr class="d-flex">
                        <th class="col" scope="col">#</th>
                        <th class="col" scope="col">Ticket Status</th>
                        <th class="col-2" scope="col">Created At</th>
                        <th class="col" scope="col">Campus</th>
                        <th class="col" scope="col">Room</th>
                        <th class="col" scope="col">Customer</th>
                        <th class="col-3" scope="col">Description</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tickets as $ticket)
                        @php
                            $campusName = App\Campus::where('id',$ticket->CampusID)->value('CampusName');
                        @endphp
                    <tr class="d-flex">
                        <td class="col p-4">
                            <a href="/tickets/{{$ticket->id}}">
                                {{$ticket->id}}
                            </a>
                        </td>
                        <td class="col p-4">{{$ticket->TicketStatus}}</td>
                        <td class="col-2 p-4">{{$ticket->created_at->format('m/d/y h:i a')}}</td>
                        <td class="col p-4">{{$campusName}}</td>
                        <td class="col p-4">{{$ticket->Room}}</td>
                        <td class="col p-4">{{$ticket->CustomerName}}</td>
                        <td class="col-3 p-4 text-overflow">{{$ticket->Description}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <span class="mt-4 float-center shadow-lg">{{$tickets->links()}}</span>
    @else
        <p>No tickets found</p>
        @push('scripts')
            <script>
                new Noty({
                        text: 'Good job! No tickets to complete! 😁',
                        type:'success',
                        layout: 'topRight',
                        timeout:3000
                    })
                    .on('onShow', function() {
                            var audio = new Audio('/sounds/appointed.mp3');
                            audio.play();
                        }).show();
            </script>
        @endpush
    @endif
    </div>

@endsection
