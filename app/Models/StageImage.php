<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StageImage extends Model
{
    use HasFactory;

    protected $fillable = ['stage_id', 'image_path'];

    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }
}