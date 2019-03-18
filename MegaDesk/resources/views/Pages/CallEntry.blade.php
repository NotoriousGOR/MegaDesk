@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{asset('css/callentry.css')}}">

    @auth
        @cannot('technician', auth()->user())
            <div class="container">
                {!! Form::open(['action' => 'TicketsController@store', 'method' => 'POST'])!!}
                    <legend style="color: white;">Call Information</legend>
                    <div id="callentryform">
                        <div class="form-row">
                            <div class="col">
                                {{Form::label('Campus', 'Campus')}}<BR>
                                {{Form::select('Campus', [01 => 'CHS', 02 => 'Kolarik', 41 => 'Alice Johnson', 43 => 'Aguirre Jr. High', 05 => 'JFC'], null, ['class' => 'form-control', 'placeholder' => 'Campus...'])}}
                            </div>
                            <div class="col">
                                {{Form::label('Extension', 'Ext.')}}
                                {{Form::text('Extension','', ['class' => 'form-control', 'placeholder' => '1234'])}}
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                {{Form::label('CustomerName', 'Customer Name')}}
                                {{Form::text('CustomerName','', ['class' => 'form-control', 'placeholder' => 'John Doe'])}}
                            </div>
                            <div class="col">
                                {{Form::label('Room', 'Room #')}}
                                {{Form::text('Room','', ['class' => 'form-control', 'placeholder' => '316'])}}
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                {{Form::label('TicketStatus', 'Status')}}<p>
                                {{Form::select('TicketStatus', ['New Issue' => 'New Issue', 'In Progress' => 'In Progress', 'Out For Repair' => 'Out For Repair', 'Completed' => 'Completed'], 'New Issue', ['class' => 'form-control'])}}
                            </div>
                            <div class="col">
                                {{Form::label('AssignedTo', 'Assigned To')}}<p>
                                {{Form::select('AssignedTo', [01 => 'Gabriel', 02 => 'Max', 03 => 'Ivan', 04 => 'Johnny', 05 => 'Kimberly'], null,['class' => 'form-control'])}}
                            </div>
                        </div>
                        <div class="form-row">
                            {{Form::label('Description', 'Description')}}
                            {{Form::textarea('Description','', ['class' => 'form-control', 'placeholder' => 'Enter Description'])}}
                        </div>
                        <br>
                        <div class="form-row">
                            <div id="eventbtn" class="col">
                                {{Form::submit('Convert', ['class' => 'btn btn-success'])}}
                            </div>
                            <div id="eventbtn" class="col">
                                <input class="btn btn-info" type="button" value="Close" onclick="window.close()">
                            </div>
                        </div>
                    </div>
                {!! Form::close()!!}
            </div>
        @endcannot
    @endauth

    @if(Auth::user()->authLvl > 2)
            <script>window.close();</script>
    @endif

@endsection
