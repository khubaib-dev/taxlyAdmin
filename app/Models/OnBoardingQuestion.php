<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnBoardingQuestion extends Model
{
    use HasFactory;

    protected $table = 'on_boarding_questions';

    protected $fillable = [
        'onBoardingIdId', 'label', 'order'
    ];
    public $timestamps = false;
}
