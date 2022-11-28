<?php

namespace App\Models;

use App\Models\ProjectLevel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rapport extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function project_level()
    {
        return $this->belongsTo(ProjectLevel::class);
    }
}
