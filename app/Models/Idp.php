<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Idp extends Model
{
    use HasFactory;
    protected $casts = [
        'competency' => 'array',
        'sug' => 'array',
        'dev_act' => 'array',
        'target_date' => 'array',
        'responsible' => 'array',
        'support' => 'array',
        'status' => 'array',
        'compfunctiondesc' => 'array',
        'diffunctiondesc' => 'array'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function AttendanceForm()
    {
        return $this->hasOne(AttendanceForm::class);
    }
    
    public function scopeFilter($query, array $filters){
        if($filters['submit_status'] ?? false){
            $query->where('submit_status','like','%'. request('submit_status') . '%');
        }
        if($filters['search'] ?? false){
            $query->whereRaw("LOWER(name) LIKE '%".strtolower(request('search'))."%'")
                ->orWhere('idps.created_at','like','%'. request('search') . '%')
                ->orWhereRaw("LOWER(competency) LIKE '%".strtolower(request('search'))."%'")
                ->orWhereRaw("LOWER(status) LIKE '%".strtolower(request('search'))."%'");
        }
    }

}
