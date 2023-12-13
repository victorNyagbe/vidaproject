<?php

namespace App\Models;

use App\Models\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invitation extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'email', 'token', 'status', 'project_id'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
