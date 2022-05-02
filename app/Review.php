<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = 
    [
        'title',
        'author',
        'performance',
        'vote',
        'review',
        'doctor_id'
    ];

    public function doctor() {
        return $this->belongsTo(Doctor::class);
    }
}
