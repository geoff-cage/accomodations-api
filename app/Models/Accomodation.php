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

    
}
