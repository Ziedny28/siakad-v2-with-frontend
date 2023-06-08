<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Model;
use Laravel\Scout\Searchable;

class Student extends Model
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

    function toSearchableArray()
    {
        return [
            'name' => $this->name,
            'ni' => $this->ni,
            'email' => $this->email,
        ];
    }
}
