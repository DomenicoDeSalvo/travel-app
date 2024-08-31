<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'date',
        'trip_id',
        'mood_id',
        'user_id'
    ];

    public function mood()
    {
        return $this->belongsTo(Mood::class);
    }

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

    public function stages()
    {
        return $this->hasMany(Stage::class);
    }
}
