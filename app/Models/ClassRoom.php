<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassRoom extends Model
{
    use HasFactory;
    protected $table = "class_rooms";

    public function scores()
    {
        return $this->hasMany(Score::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class,  'teacher_class_room', 'class_room_id', 'teacher_id');
    }


    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
