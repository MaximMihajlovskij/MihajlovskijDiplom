<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'rating', 'user_id', 'camera_id', 'turniket_id', 'barrier_id', 'accessorie_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function camera()
    {
        return $this->belongsTo(Camera::class);
    }

    public function turniket()
    {
        return $this->belongsTo(Turniket::class);
    }

    public function barrier()
    {
        return $this->belongsTo(Barrier::class);
    }

    public function accessorie()
    {
        return $this->belongsTo(Accessorie::class);
    }
}
