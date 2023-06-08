<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Score extends Model
{
    use HasFactory, Searchable;
    protected $guarded = ['id'];
    public $timestamps = false;


    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    function toSearchableArray()
    {
        return [
            'class_room_id' => $this->task->class_room_id,
        ];
    }
}
