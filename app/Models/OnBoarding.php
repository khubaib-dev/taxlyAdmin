<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnBoarding extends Model
{
    use HasFactory;

    protected $fillable = [
        'occupation_id', 'criteria_id', 'icon', 'heading', 
        'sub_heading', 'type'
    ];

    protected $with = [
        'questions', 'occupation', 'criteria'
    ];

    public function questions()
    {
        return $this->hasMany(OnBoardingQuestion::class, 'on_boarding_id', 'id');
    }

    public function occupation()
    {
        return $this->belongsTo(Occupation::class, 'occupation_id', 'id');
    }
    
    public function criteria()
    {
        return $this->belongsTo(Criterion::class, 'criteria_id', 'id');
    }

    public function getTypeAttribute($type)
    {
        if($type == 1) return 'CheckBox';
        if($type == 0) return 'Radio';
    }
    
    public function getIconAttribute($icon)
    {
        return asset('files/' . $icon);
    }
}
