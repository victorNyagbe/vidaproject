<?php

namespace App\Models;

use App\Models\ProjectUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CollabStatus extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function project_users()
    {
        return $this->hasMany(ProjectUser::class);
    }
}
