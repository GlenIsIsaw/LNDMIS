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
    public function scopeFilter($query, array $filters){
        if($filters['level'] ?? false){
            $query->where('level','like','%'. request('level') . '%');
        }
        if($filters['search'] ?? false){
            $query->where('certificate_title','like','%'. request('search') . '%')
            ->orWhere('venue','like','%'. request('search') . '%')
            ->orWhere('sponsors','like','%'. request('search') . '%')
            ->orWhere('certificate_type','like','%'. request('search') . '%')
            ->orWhere('type','like','%'. request('search') . '%')
            ->orWhere('name','like','%'. request('search') . '%')
            ->orWhere('level','like','%'. request('search') . '%');
        }
    }

}
