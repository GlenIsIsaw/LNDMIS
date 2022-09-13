<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceForm extends Model
{
    use HasFactory;

    public function listoftraining()
    {
        return $this->belongsTo(ListOfTraining::class);
    }
}
