<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = ['name', 'price'];

    public function doctors() {
        return $this->belongsToMany(Doctor::class);
    }
}
