<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Model;

class Student extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public $timestamps = false;

    public function scores()
    {
        return $this->hasMany(Score::class);
    }

    public function class_room()
    {
        return $this->belongsTo(ClassRoom::class);
    }
}
