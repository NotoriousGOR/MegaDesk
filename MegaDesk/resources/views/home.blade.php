{{--
/*
 * File: c:\Users\grosales\Documents\project-falcon\Project-Falcon\resources\views\home.blade.php
 * Project: c:\Users\grosales\Documents\project-falcon\Project-Falcon
 * Created Date: Thursday, December 13th 2018, 2:54:05 pm
 * Author: Gabriel Rosales
 * -----
 * Date Modified: 02/21/2019, 1:38:26
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
    @php
        $chartType = 'horizontalBar';
    @endphp

    <div class="container d-flex flex-column justify-content-between align-items-center">
        <chart-component
        :dataset= {{json_encode($avgArray)}}
        :mylabels= {{json_encode($campusNames)}}
        :chart = {{json_encode($chartType)}}
        ></chart-component>

        <div class="table-responsive mt-3">
            <table class="table table-light table-hover text-center table-striped">
                <thead>
                    <tr>
                        <th scope="col" colspan="2"></th>
                        <th scope="col">New Issue:</th>
                        <th scope="col">In Progress:</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($campuses as $campus)
                        @php
                            $inProgress = 0;
                            $newIssue = 0;
                        @endphp
                        @foreach ($tickets as $ticket)
                            @if ($ticket->CampusID == $campus->id && $ticket->TicketStatus == "New Issue" )
                                @php
                                    $newIssue++;
                                @endphp
                            @elseif($ticket->CampusID == $campus->id && $ticket->TicketStatus == "In Progress")
                                @php
                                    $inProgress++;
                                @endphp
                            @endif
                        @endforeach
                        <tr>
                            <td colspan="2">
                            <a class="campusLinks" href="/search/?campuses%5B%5D={{$campus->id}}&users%5B%5D={{auth()->user()->id}}&status%5B%5D=New+Issue&status%5B%5D=In+Progress">{{$campus->CampusName}}</a>
                            </td>
                            <td>
                                <div class="counter">{{$newIssue}}</div>
                            </td>
                            <td>
                                <div class="counter">{{$inProgress}}</div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
