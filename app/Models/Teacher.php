<?php

namespace App\Models;

use App\Models\Subject;
use Illuminate\Foundation\Auth\User as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Scout\Searchable;

class Teacher extends Model
{
    use HasFactory, Searchable;

    protected $guarded = ['id'];
    public $timestamps = false;

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function class_rooms()
    {
        return $this->belongsToMany(ClassRoom::class, 'teacher_class_room', 'teacher_id', 'class_room_id');
    }

    public function class_room()
    {
        return $this->hasOne(ClassRoom::class);
    }

    function toSearchableArray()
    {
        return [
            'name' => $this->name,
            'ni' => $this->ni,
            'email' => $this->email,
        ];
    }
}
