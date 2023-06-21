<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Task extends Model
{
    use HasFactory, Searchable;
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

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    function toSearchableArray()
    {
        return ['name' => $this->name];
    }
}
