<?php

namespace App\Models;

use App\Models\ProjectUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mail extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function project_user()
    {
        return $this->belongsTo(ProjectUser::class);
    }
}
