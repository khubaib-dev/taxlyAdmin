<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criterion extends Model
{
    use HasFactory;

    protected $table = 'criterion';
    public $timestamps = false;

    protected $fillable = [
        'name', 'values'
    ];
}
