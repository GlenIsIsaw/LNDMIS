<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomingTrainings extends Model
{
    use HasFactory;

    public function colleges()
    {
        return $this->belongsTo(College::class);
    }
}


