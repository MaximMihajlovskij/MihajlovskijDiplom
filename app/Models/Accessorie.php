<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Accessorie extends Model
{
    protected $fillable = ['turniket_id', 'camera_id', 'barrier_id', 'name', 'image', 'description', 'price', 'quantity'];

    public function turniket()
    {
        return $this->belongsTo(Turniket::class);
    }

    public function camera()
    {
        return $this->belongsTo(Camera::class);
    }

    public function barrier()
    {
        return $this->belongsTo(Barrier::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}

