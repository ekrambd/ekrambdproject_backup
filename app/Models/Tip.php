<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tip extends Model
{
    protected $fillable = [
        'tips_name',
        'category_id',
        'category_type',
        'message_box',
        'league_name',
        'teams',
        'odds_value', 
        'date',
    ];
}
