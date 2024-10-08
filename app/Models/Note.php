<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'day_id',
        'user_id',
        'text'

    ];

    public function day()
    {
        return $this->belongsTo(Day::class);
    }

}
