<?php

namespace App\Models;

use App\Models\Mail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fichier extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function mail()
    {
        return $this->belongsTo(Mail::class, 'mail_id');
    }
}
