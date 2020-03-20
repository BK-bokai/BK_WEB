<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentSkill extends Model
{
    protected $table = 'studentskill';
    protected $fillable = [
        'skill'
    ];
}
