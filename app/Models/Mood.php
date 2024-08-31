<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mood extends Model
{
    use HasFactory;

    public function days()
    {
        return $this->hasMany(Day::class);
    }

    public function stages()
    {
        return $this->hasMany(Stage::class);
    }
}
