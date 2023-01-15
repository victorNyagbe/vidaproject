<?php

namespace App\Models;

use App\Models\ProjectType;
use App\Models\ProjectLevel;
use App\Models\ProjectStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function project_types()
    {
        return $this->belongsToMany(ProjectType::class, 'project_type_pivots');
    }

    public function project_status()
    {
        return $this->belongsTo(ProjectStatus::class);
    }

    public function project_level()
    {
        return $this->belongsTo(ProjectLevel::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

}
