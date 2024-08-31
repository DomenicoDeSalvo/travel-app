<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'day_id',
        'mood_id',
        'user_id',
        'thumb',
        // 'longitude',
        // 'latitude',
        // 'address'
    ];

    public function day()
    {
        return $this->belongsTo(Day::class);
    }
}
