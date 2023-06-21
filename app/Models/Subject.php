<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Subject extends Model
{
    use HasFactory, Searchable;

    protected $guarded = ['id'];

    public $timestamps = false;
    public function scores()
    {
        return $this->hasMany(Scores::class);
    }

    public function teachers()
    {
        return $this->hasMany(Teacher::class);
    }

    function toSearchableArray()
    {
        return [
            'name' => $this->name,
            'description' => $this->description
        ];
    }
}
