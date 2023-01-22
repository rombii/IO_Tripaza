<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Trip extends Model
{
    use HasFactory;

    protected $fillable = [
        'country',
        'city',
        'begin_date',
        'end_date',
        'price_person',
        'last_minute',
        'food_option',
        'participants_number_left'
    ];

    public function favourites() {
        return $this->belongsToMany(User::class, 'favourites');
    }

    public function favouriteExists() {
        return Auth::user()->favouritesUser()->where('trip_id', '=', $this->id)->exists();
    }

    public function reservationExists() {
        return Auth::user()->reservations()->where('trip_id', '=', $this->id)->exists();
    }

    public function reservations() {
        return $this->hasMany(Reservation::class);
    }

    public function getPrice() {
        return Auth::user()->reservations()->where('trip_id', '=', $this->id)->first()->price_person;
    }

    public function getSeats() {
        return Auth::user()->reservations()->where('trip_id', '=', $this->id)->first()->number_of_seats;
    }

    public function calcPrice($trip_id) {
        $isTripTheDeal = Trip::where('begin_date', '>', Carbon::now())->where('participants_number_left', '>', 0)->offset(((Carbon::now()->day)%Trip::count())-1)->limit(1)->get();
        // if($trip_id == $isTripTheDeal[0]->id)
        // {
        //     $number = floor($this->price_person * 0.6 + 1);
        //     $diff = $number - $this->price_person * 0.6;
        //     return number_format((float)$this->price_person * 0.6 + ($diff - 0.01), 2, '.', '');
        // }
        // else
        // {
        //     if($this->begin_date > Carbon::now()->addMonths(6))
        //     {
        //         $number = floor($this->price_person * 0.9 + 1);
        //         $diff = $number - $this->price_person * 0.9;
        //         return number_format((float)$this->price_person * 0.9 + ($diff - 0.01), 2, '.', '');
        //     }
        //     if($this->begin_date < Carbon::now()->addDays(5))
        //     {
        //         $number = floor($this->price_person * 0.75 + 1);
        //         $diff = $number - $this->price_person * 0.75;
        //         return number_format((float)$this->price_person * 0.75 + ($diff - 0.01), 2, '.', '');
        //     }
        //     return $this->price_person;
        // }
        return $this->price_person;
    }

}
