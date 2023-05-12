<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accomodation extends Model
{
    use HasFactory;

    protected $fillable =[
        'accomodation_no',
        'accomodation_name',
        'location',
        'institution_id'
    ];

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}
