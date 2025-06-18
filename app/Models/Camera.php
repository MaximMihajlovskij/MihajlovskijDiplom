<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Camera extends Model
{
    protected $table = "cameras";
    protected $fillable = [
        'name_camera',
        'model',
        'serial_namber',
        'image',
        'price',
        'firm_id',
        'quantity',
    ];
    
    public function firm()
    {
        return $this->belongsTo(Firm::class, 'firm_id');
    }

    public function accessories()
    {
        return $this->hasMany(Accessorie::class, 'camera_id');
    }

    public function specifications()
    {
        return $this->hasMany(Specification::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}