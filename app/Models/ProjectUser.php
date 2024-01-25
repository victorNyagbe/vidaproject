<?php

namespace App\Models;

use App\Models\Mail;
use App\Models\User;
use App\Models\Project;
use App\Models\ClientStatus;
use App\Models\CollabStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProjectUser extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function collab_statuses()
    {
        return $this->hasMany(CollabStatus::class);
    }

    public function client_status()
    {
        return $this->belongsTo(ClientStatus::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function mails()
    {
        return $this->hasMany(Mail::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }
}
