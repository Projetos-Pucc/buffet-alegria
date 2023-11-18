<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SatisfactionQuestion extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function user_answers(){
        return $this->hasMany(SatisfactionAnswer::class, 'question_id');
    }
}
