<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

Use Auth;
Use App\User;
Use App\Campus;
Use DB;
use Gate;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (Gate::denies('administrator')) {
           return redirect('/')->with('error', 'Unauthorized Page');
        }

        $users = User::orderBy('name','asc')->paginate(10);

        return view('users/index', compact('users'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $user = User::find($user->id);
        $campuses = $user->Campuses->where('TechID', $user->id);

        $avgArray = array();
        $campusNames = array();
        $ticketAgeArray = array();

        $allCampuses = Campus::all();

        foreach($campuses as $campus) {
            // adding campus name to array
            $campusNames[] = $campus->CampusName;

            // calling the average age function in the ticket model
            $avgAge = $campus->tickets->where('TicketStatus','!=','Completed')->average('age');

            // appending variable to array
            $avgArray[] = round($avgAge);
        }

        if (Gate::allows('administrator') || $user->id == auth()->user()->id) {
            return view('users/show')->with([
                'user' => $user,
                'avgArray' => $avgArray,
                'campusNames' => $campusNames,
                'allCampuses' => $allCampuses
            ]);
        }
        else {
            return redirect('/')->with('error', 'Unauthorized Page');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if (Gate::denies('administrator')) {
           return redirect('/')->with('error', 'Unauthorized Page');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if (Gate::denies('administrator')) {
           return redirect('/')->with('error', 'Unauthorized Page');
        }
        else {
            $request->validate([
                'name' => ['required','max:50'],
                'email' => ['required','email'],
                'authLevel' => ['required','lte:4'],
                'campuses' => ['required','array']
            ]);

            Campus::where('TechID', $user->id)->update(['TechID' => 999]);

            //Update User
            foreach($request->campuses as $campus) {
                Campus::where('id', $campus)->update(['TechID' => $user->id]);
            }
            $user->name = $request->name;
            $user->email = $request->email;
            $user->authLvl = $request->authLevel;
            $user->save();

            return redirect('/users/'.$user->id)->with('success', 'User Updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (Gate::denies('administrator')) {
           return redirect('/')->with('error', 'Unauthorized Page');
        }
        else if (Auth::attempt(['email' => auth()->user()->email, 'password' => request('password')]) && $user->id !== auth()->user()->id) {
            $user->delete();
            return redirect('/users')->with('success', 'User '.$user->name.' deleted');
        }
        else if (!Auth::attempt(['email' => auth()->user()->email, 'password' => request('password')])) {
            return redirect('/users')->with('error', 'Wrong password');
        }
        else if ($user->id == auth()->user()->id) {
            return redirect('/users')->with('error', "You can't delete yourself silly");
        }
    }
}
