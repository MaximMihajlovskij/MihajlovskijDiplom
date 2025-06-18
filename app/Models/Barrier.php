<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barrier extends Model
{
    protected $table = "barriers";

    protected $fillable = [
        'name_barrier',
        'model',
        'serial_namber',
        'image',
        'description',
        'price',
        'firm_id',
        'quantity',
    ];
    
    public function firm()
    {
        return $this->belongsTo(Firm::class, 'firm_id');
    }

    public function specifications()
    {
        return $this->hasMany(Specification::class, 'barrier_id');
    }  

    public function accessories()
    {
        return $this->hasMany(Accessorie::class, 'barrier_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
