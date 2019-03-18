<?php

namespace App\Listeners;

use Auth;
use App\User;
use Carbon\Carbon;

use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserEventListener
{
    public function onUserLogin($event) {
        $userID = Auth::user()->id;
        $user = User::find($userID);

        $user->updated_at = Carbon::now();
        $user->save();

        $count = 0;

        foreach ($user->tickets->where('TicketStatus','!=','Completed') as $ticket) {
            if($ticket->age >= 5) {
                $count++;
            }
        }

        if($count >= 5) {
            return redirect('home')->with(['status' => 'Welcome '.Auth::user()->name .' 😁',
            'error' => 'You have '.$count.' tickets over 5 work days old'.' 😞']);
        }
        else {
            return redirect('home')->with('status', 'Welcome '.Auth::user()->name .' 😁');
        }
    }
}
