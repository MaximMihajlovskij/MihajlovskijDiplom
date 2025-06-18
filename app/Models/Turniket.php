<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Turniket extends Model
{
    protected $table = "turnikets";

    protected $fillable = [
        'name_turniket',
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
        return $this->hasMany(Specification::class, 'turniket_id');
    }    

    public function accessories()
    {
        return $this->hasMany(Accessorie::class, 'turniket_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
