<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;
use App\Campus;
use PDF;
class TicketsController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $techID = auth()->user()->id;

        $tickets = Ticket::where('AssignedTo',$techID)->where('TicketStatus','!=','Completed')->paginate(10);

        return view('Pages.Queue')->with('tickets',$tickets);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Pages.CallEntry');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'Campus' => 'required',
            'Extension' => 'required',
            'CustomerName' => 'required',
            'Room' => 'required',
            'TicketStatus' => 'required',
            'AssignedTo' => 'required',
            'Description' => 'required'
        ]);

        //Create the ticket
        Ticket::create([
            'AssignedTo' => $request->input('AssignedTo'),
            'CustomerName' => $request->input('CustomerName'),
            'CampusID' => $request->input('Campus'),
            'Room' => $request->input('Room'),
            'Extension' => $request->input('Extension'),
            'Description' => $request->input('Description'),
            'TicketStatus' => $request->input('TicketStatus')
        ]);

        return redirect('/callEntry')->with('success','Ticket Entered');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        $campusName = Campus::where('id', $ticket->CampusID)->value('CampusName');
        return view('tickets/show')->with(['ticket' => $ticket, 'CampusName' => $campusName]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        //Check for correct user
        if(auth()->user()->id !== $ticket->AssignedTo) {
            return redirect('/')->with('error', 'Unauthorized Page');
        }

        return view('tickets/edit')->with('ticket', $ticket);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        $request->validate([
            'TicketStatus' => 'required',
            'Comments' => 'required'
        ]);

        //Update Ticket
        $ticket->TicketStatus = $request->TicketStatus;
        $ticket->Comments = $request->Comments;
        $ticket->save();

        return redirect("/tickets/".$ticket->id)->with('success', 'Ticket Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function pdfGenerator($id)
    {

        $ticket = Ticket::where('id', $id)->first();

        $data = ['ticket' => $ticket];
        $pdf = PDF::loadView('tickets/generate', $data);

        return $pdf->stream('Ticket-'.$ticket->id.'.pdf');
    }
}
