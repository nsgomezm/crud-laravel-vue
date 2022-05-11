<?php

namespace App\Models;

use App\Models\Bill;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shopping extends Model
{
    use HasFactory;

    public function bills()
    {
        return $this->belongsTo(Bill::class, 'id_bills');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_producto');
    }


}
