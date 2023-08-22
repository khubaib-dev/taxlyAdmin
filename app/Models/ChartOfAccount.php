<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChartOfAccount extends Model
{
    use HasFactory;

    protected $table = 'chart_of_account';
    public $timestamps = false;

    protected $fillable = [
        'category', 'parent_id', 'code'
    ];
}
