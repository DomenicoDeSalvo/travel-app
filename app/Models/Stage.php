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
    ];

    public function day()
    {
        return $this->belongsTo(Day::class);
    }

    public function mood()
    {
        return $this->belongsTo(Mood::class);
    }

    public function images()
    {
        return $this->hasMany(StageImage::class);
    }
}
