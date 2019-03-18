<?php

/*
 * File: c:\Users\grosales\Documents\project-falcon\Project-Falcon\app\Ticket.php
 * Project: c:\Users\grosales\Documents\project-falcon\Project-Falcon
 * Created Date: Tuesday, December 18th 2018, 8:09:21 am
 * Author: Gabriel Rosales
 * -----
 * Date Modified: 02/19/2019, 11:31:14
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

namespace App;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;
use App\Tools\BusinessDays;

class Ticket extends Model
{
    protected $fillable = [
        'AssignedTo',
        'CustomerName',
        'CampusID',
        'Room',
        'Extension',
        'Description',
        'TicketStatus'
    ];

    protected $table = 'tickets';

    protected $primaryKey = 'id';

    public $timestamps = true;

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function campus()
    {
        return $this->belongsTo(Campus::class);
    }

     public function getAgeAttribute()
    {
        $date = new BusinessDays();

        $today = Carbon::now();
        $createdAt = $this->created_at;

        $age = $date->daysBetween($createdAt,$today);

        return $age;
    }

    public function getTicketAverageAgePerCampus()
    {
        $campuses = Campus::with(['tickets' => function ($query) {
            $query->where('TicketStatus', '!=', 'Completed')->where('TicketStatus', '!=', 'Completed');
        }]);

        $averageTicketAges = [];

        foreach ($campuses as $campus) {
            $averageTicketAges[$campus->id] = $campus->tickets->average('age');
        }
    }

    public function scopeCustomer($query, $name) {
        $result = $query->where('CustomerName', 'like', "%{$name}%")->get();
       return ($result);
    }

    public function scopeStatus($query, $status) {
        $result = $query->whereIn('TicketStatus', $status)->get();
        return ($result);
    }

    public function scopeTicketID($query, $ticketID) {
        $result = $query->where('id', $ticketID)->get();
        return ($result);
    }

    public function scopeUser($query, $user) {
        $result = $query->whereIn('AssignedTo', $user)->get();
        return ($result);
    }

    public function scopeCampus($query, $campus) {
        $result = $query->whereIn('CampusID', $campus)->get();
        return ($result);
    }

    public function scopeRoom($query, $room) {
        $result = $query->where('Room', $room)->get();
        return ($result);
    }

    public function scopeExtension($query, $ext) {
        $result = $query->where('Extension', $ext)->get();
        return ($result);
    }

    public function scopeTimeFrame($query, $from, $to) {
        $result = $query->whereBetween('created_at', [$from, $to])->get();
        return ($result);
    }

}

