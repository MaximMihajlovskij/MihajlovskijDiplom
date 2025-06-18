<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $table = "wishlists";
    protected $fillable = ['user_id', 'camera_id', 'turniket_id', 'barrier_id', 'accessory_id', 'quantity'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function camera()
    {
        return $this->belongsTo(Camera::class, 'camera_id');
    }

    public function turniket()
    {
        return $this->belongsTo(Turniket::class, 'turniket_id');
    }

    public function barrier()
    {
        return $this->belongsTo(Barrier::class, 'barrier_id');
    }

    public function accessorie()
    {
        return $this->belongsTo(Accessorie::class, 'accessory_id');
    }
}
