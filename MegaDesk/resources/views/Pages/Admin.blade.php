{{--
    /*
 * File: /Users/gabrielrosales/Documents/GitHub/project-falcon/Project-Falcon/resources/views/Pages/Admin.blade.php
 * Project: /Users/gabrielrosales/Documents/GitHub/project-falcon/Project-Falcon
 * Created Date: Monday, January 14th 2019, 8:17:45 pm
 * Author: Gabriel Rosales
 * -----
 * Date Modified: 01/14/2019, 8:20:37
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
 */
 --}}


 @extends('layouts.app')

 @section('content')
    <link rel="stylesheet" href="{{asset('css/Admin.css')}}">
    <div class="container d-flex flex-column justify-content-between align-items-center">
        <line-chart
            :labels = {{json_encode($dates)}}
            :created = {{json_encode($createdTickets)}}
            :closed = {{json_encode($closedTickets)}}>
        </line-chart>

        <div class="table-responsive">
            <table class="table table-light table-hover text-center table-striped" class="table text-center">
                <thead>
                    <tr>
                        <th scope="col" colspan="2">User</th>
                        <th scope="col" colspan="2">Campuses</th>
                        <th scope="col" colspan="2">Avg. Age Of Open Tickets</th>
                        <th scope="col"># Of Open Tickets</th>
                        <th scope="col"># Of Tickets over 5 days</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        @foreach ($user->tickets->where('TicketStatus','!=','Completed') as $ticket)
                            @if($ticket->age >= 5)
                                @php
                                    $count++
                                @endphp
                            @endif
                        @endforeach
                        <tr>
                            <td scope="col" colspan="2">
                                <a href="users/{{$user->id}}">{{$user->name}}</a>
                            </td>
                            <td scope="col" colspan="2">
                                {{$user->Campuses->implode('CampusName', ', ')}}
                            </td>
                            <td scope="col" colspan="2">
                                {{round($user->tickets->where('TicketStatus','!=','Completed')->average('age'))}}
                                @if (round($user->tickets->where('TicketStatus','!=','Completed')->average('age')) > 0)
                                     days
                                @elseif(round($user->tickets->where('TicketStatus','!=','Completed')->average('age')) == 1)
                                     day
                                @endif
                            </td>
                            <td scope="col">
                                {{$user->tickets->where('TicketStatus','!=','Completed')->count()}}
                            </td>
                            <td scope="col" colspan="2">
                                {{$count}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
 @endsection
