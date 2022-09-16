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

}
