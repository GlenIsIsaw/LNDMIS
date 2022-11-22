<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class College extends Model
{
    use HasFactory,SoftDeletes;

    public function users()
    {
        return $this->hasOne(User::class);
    }
    public function invitaion()
    {
        return $this->hasOne(IncomingTrainings::class);
    }
}
