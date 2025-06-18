<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Specification extends Model
{
    protected $fillable = ['turniket_id', 'camera_id', 'barrier_id', 'key', 'value'];

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
}
