<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $table = 'order_products';

    protected $guarded = [];

    // دا جدول مستقل بذاته عشان نحسب الاسناب شوتس بتاعت البرودكت وقت الشراء
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
