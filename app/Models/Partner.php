<?php

namespace App\Models;

use App\Models\ClientStatus;
use App\Models\CollabStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Partner extends Model
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
}
