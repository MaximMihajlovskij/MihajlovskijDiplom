<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = "carts";

    protected $fillable = ['user_id', 'payment_method', 'delivery_method', 'diliveryaddress', 'paymentstatus', 'total_price', 'delivery_cost', 'action_id', 'complete_id'];

    public function items()
    {
        return $this->hasMany(CartItem::class, 'cart_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function action()
    {
        return $this->belongsTo(Action::class,'action_id');
    }

    public function completed()
    {
        return $this->belongsTo(Completed::class,'complete_id');
    }
}
