<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $table = "cartsitems";
    
    protected $fillable = [
        'cart_id',
        'camera_id',
        'turniket_id',
        'barrier_id',
        'accessorie_id',
        'quantity',
        'image_url',
    ];    

    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id');
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
        return $this->belongsTo(Accessorie::class, 'accessorie_id');
    }
}
