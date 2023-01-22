<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'number_of_seats',
        'price_person',
    ];

    public function findTrip() {
        return Trip::findOrFail($this->trip_id);
    }
}
