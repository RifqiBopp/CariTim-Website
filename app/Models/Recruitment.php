<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recruitment extends Model
{
    protected $fillable = [
        'user_id',
        'competitions_id',
        'title',
        'description',
        'status'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function applications() {
        return $this->hasMany(Application::class);
    }

    public function competition() {
        return $this->belongsTo(Competition::class, 'competitions_id');
    }
}
