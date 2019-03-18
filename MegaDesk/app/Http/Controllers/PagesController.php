<?php
/*
 * File: c:\Users\grosales\Documents\project-falcon\Project-Falcon\app\Http\Controllers\PagesController.php
 * Project: c:\Users\grosales\Documents\project-falcon\Project-Falcon
 * Created Date: Wednesday, December 5th 2018, 9:06:37 am
 * Author: Gabriel Rosales
 * -----
 * Date Modified: 03/01/2019, 1:25:03
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
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Gate;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Tools\BusinessDays;

use PDF;
use App\User;
use App\Campus;
use App\Ticket;

class PagesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Dashboard Page
    public function index()
    {
        if(Gate::denies('administrator')) {
            $userID =  Auth::user()->id;
            $user = User::find($userID);

            $tickets = $user->tickets;
            $campuses = $user->Campuses->where('TechID', $userID);

            $avgArray = array();
            $campusNames = array();
            $ticketAgeArray = array();

            foreach($campuses as $campus) {
                // adding campus name to array
                $campusNames[] = $campus->CampusName;

                // calling the average age function in the ticket model
                $avgAge = $campus->tickets->average('age');

                // appending variable to array
                $avgArray[] = round($avgAge);
            }

            return view('home')->with([
                'user' => $user,
                'campuses'=>$campuses,
                'tickets'=>$tickets,
                'avgArray' => $avgArray,
                'campusNames' => $campusNames]);
        }
        else {
            $businessDay = new BusinessDays();
            $users = User::orderBy('name','asc')->get();
            $count = 0;
            $dates = array();
            $today = Carbon::now();
            $from = Carbon::now()->subMonths(2);

            $period = CarbonPeriod::create($from, $today);

            foreach ($period as $date) {

                if($businessDay->isOpenedDay($date) == true && !$businessDay->isHoliday($date) && !$businessDay->isClosed($date)) {
                    $closedTickets[] = Ticket::where('TicketStatus','Completed')->whereDate('created_at', $date)->count();

                    $createdTickets[] = Ticket::where('TicketStatus','New Issue')->whereDate('created_at', $date)->count();

                    $dates[] = $date->format('m/d/Y');
                }

            }

            return view('Pages.Admin')->with([
                'users' => $users,
                'count' => $count,
                'dates' => $dates,
                'createdTickets' => $createdTickets,
                'closedTickets' => $closedTickets
            ]);
        }
    }


    // Reports Page
    public function Reports() {
        return view('Pages.Reports');
    }
    // Search Page
    public function Search(Request $request, Ticket $ticket) {

        $results = array();

        if(!empty($request->all())) {
            $q = $ticket->newQuery();

            $request->validate([
                'users' => 'exists:users,id|nullable',
                'campuses' => 'exists:campuses,id|nullable',
                'status' => 'nullable',
                'first' => 'max:50|regex:/^[a-zA-Z]+$/u|string|nullable',
                'last' => 'max:50|regex:/^[a-zA-Z]+$/u|string|nullable',
                "ticketID" => 'integer|nullable',
                "room" => 'max:10|string|nullable',
                "ext" => 'integer|nullable',
                "fromDate" => 'Date|before_or_equal:toDate|nullable',
                "toDate" => "Date"
            ]);

            if ($request->users !== null) {
                $q->user($request->users);
            }

            if ($request->campuses !== null) {
                $q->campus($request->campuses);
            }

            if ($request->status !== null) {
                $q->status($request->status);
            }

            if ($request->first !== null && $request->last !== null) {
                $name = $request->first . ' ' . $request->last;

                $q->customer($name);
            } else if ($request->first !== null && $request->last == null) {

                $q->customer($request->first);
            } else if ($request->last !== null && $request->first == null) {

                $q->customer($request->last);
            }

            if ($request->ticketID !== null) {
                $q->ticketID($request->ticketID);
            }

            if ($request->room !== null) {
                $q->room($request->room);
            }

            if ($request->ext !== null) {
                $q->extension($request->ext);
            }

            if ($request->fromDate !== null && $request->toDate !== null) {
                $q->timeFrame($request->fromDate, $request->toDate);
            }

            $results = $q->orderBy('id', 'asc')->get();
        }

        $users = User::all();
        $today = Carbon::now()->format('Y-m-d');
        $campuses = Campus::all();

        return view('Pages.Search')->with([
            'campuses' => $campuses, 'today' => $today, 'users' => $users, 'results' => $results
        ]);
    }

    // CallCenter page
    public function CallCenter() {
        return view('Pages.CallCenter');
    }

    public function adminSettings() {
        return view('admin.settings');
    }

}
