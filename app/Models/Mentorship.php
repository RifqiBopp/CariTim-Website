<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mentorship extends Model
{
    protected $fillable = [
        'student_id',
        'lecturer_id',
        'competition_id',
        'status',
        'message'
    ];

public function student() {
    return $this->belongsTo(User::class, 'student_id');
}

public function lecturer() {
    return $this->belongsTo(User::class, 'lecturer_id');
}

public function competition() {
    return $this->belongsTo(Competition::class);
}
}