<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_no',
        'room_name',
        'price',
        'type',
        'status',
        'accomodation_id'
    ];

    public function accomodation()
    {
        return $this->belongsTo(Accomodation::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
