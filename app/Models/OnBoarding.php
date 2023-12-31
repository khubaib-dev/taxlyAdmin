<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnBoarding extends Model
{
    use HasFactory;

    protected $table = 'on_boardings';

    protected $fillable = [
        'occupation_id', 'profession_id', 'criteria_id', 'icon', 'heading', 
        'sub_heading', 'type'
    ];

    protected $with = [
        'questions', 'occupation', 'criteria', 'profession'
    ];

    public function profession()
    {
        return $this->belongsTo(Profession::class, 'profession_id', 'id');
    }

    public function questions()
    {
        return $this->hasMany(OnBoardingQuestion::class, 'onBoardingIdId', 'id');
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

    public $timestamps = false;
}
