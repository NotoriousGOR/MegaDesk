{{--
/*
 * File: c:\Users\grosales\Documents\project-falcon\Project-Falcon\resources\views\tickets\generate.blade.php
 * Project: c:\Users\grosales\Documents\project-falcon\Project-Falcon
 * Created Date: Friday, March 1st 2019, 12:38:29 pm
 * Author: Gabriel Rosales
 * -----
 * Date Modified: 03/01/2019, 3:15:19
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

 <!DOCTYPE html>
 <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>MegaDesk Ticket </title>
        <style>
            body {
                font-family: 'Helvetica', 'Arial', sans-serif;
            }
            table {
                border: 1px solid black;
                padding: 1%;
                border-collapse: collapse;
                text-align: center;
                min-width: 90vw;
            }
            thead {
                border: 1px solid red;
                padding: 1%;
                text-align: center;

            }
            th,td {
                padding: 1%;
                text-align: center;
                border: 1px solid black;

            }
            #div {
                height: 350px;
            }
            #comp {
                border-bottom: 1px solid black;
                margin-bottom: 4px;
            }

        </style>
    </head>
    <body>
        <header>
            <small id="comp">Channelview ISD</small>
                <br>
            <small id="date">Printed On: {{Carbon\Carbon::now()}}</small>

        </header>
        <div>
            <legend><h1>Ticket Details:</h1></legend>
            <fieldset>
                <div>
                    <h2>Ticket ID: {{$ticket->id}}</h2>

                    <h4>Assigned To: {{App\User::where('id',$ticket->AssignedTo)->value('name')}}</h4>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Ticket Status</th>
                            <th>Created At</th>
                            <th>Customer Name</th>
                            <th>Campus</th>
                            <th>Room</th>
                            <th>Extension</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                {{$ticket->TicketStatus}}
                            </td>
                            <td>
                                {{$ticket->created_at->format('F d, Y h:i a')}}
                            </td>
                            <td>
                                {{$ticket->CustomerName}}
                            </td>
                            <td>
                                {{App\Campus::where('id', $ticket->CampusID)->value('CampusName')}}
                            </td>
                            <td>
                                {{$ticket->Room}}
                            </td>
                            <td>
                                {{$ticket->Extension}}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table>
                    <thead>
                        <tr>
                            <th>
                                Description
                            </th>
                            <th>
                                Comments
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                {{$ticket->Description}}
                            </td>
                            <td>
                                {{$ticket->Comments}}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </fieldset>
        </div>
        <div id="div">
            <h1>Additional Notes:</h1>
            <hr>
        </div>
        <footer>
            <hr>
            <small>Printed By: {{auth()->user()->name}}</small>
        </footer>
    </body>
 </html>
