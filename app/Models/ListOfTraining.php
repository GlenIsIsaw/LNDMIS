<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListOfTraining extends Model
{
    use HasFactory;

    public function user()
{
    return $this->belongsTo(User::class);
}
    public function AttendanceForm()
    {
        return $this->hasOne(AttendanceForm::class);
    }

}
