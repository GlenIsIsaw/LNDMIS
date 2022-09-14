<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceForm extends Model
{
    use HasFactory;

    public function ListOfTraining()
    {
        return $this->belongsTo(ListOfTraining::class);
    }
}
