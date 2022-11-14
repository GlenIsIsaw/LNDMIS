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
    public function qem()
    {
        return $this->hasOne(Qem::class);
    }
    public function scopeFilter($query, array $filters){
        if($filters['level'] ?? false){
            $query->where('level','like','%'. request('level') . '%');
        }
        if($filters['status'] ?? false){
            $query->where('status','like','%'. request('status') . '%');
        }
        if($filters['search'] ?? false){
            $query->whereRaw("LOWER(certificate_title) LIKE '%".strtolower(request('search'))."%'")
            ->orwhereRaw("LOWER(venue) LIKE '%".strtolower(request('search'))."%'")
            ->orwhereRaw("LOWER(sponsors) LIKE '%".strtolower(request('search'))."%'")
            ->orwhereRaw("LOWER(certificate_type) LIKE '%".strtolower(request('search'))."%'")
            ->orwhereRaw("LOWER(type) LIKE '%".strtolower(request('search'))."%'")
            ->orwhereRaw("LOWER(name) LIKE '%".strtolower(request('search'))."%'")
            ->orwhereRaw("LOWER(level) LIKE '%".strtolower(request('search'))."%'")
            ->orwhereRaw("LOWER(status) LIKE '%".strtolower(request('search'))."%'");
        }
    }

}
