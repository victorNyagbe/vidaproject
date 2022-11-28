<?php

namespace App\Models;

use App\Models\Project;
use App\Models\Rapport;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProjectLevel extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function rapports()
    {
        return $this->hasMany(Rapport::class);
    }
}
