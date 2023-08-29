<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnBoardingQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'on_boarding_id', 'label'
    ];
}
