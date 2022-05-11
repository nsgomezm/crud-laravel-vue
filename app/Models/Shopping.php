<?php

namespace App\Models;

use App\Models\Bill;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shopping extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_bills',
        'id_producto',
        'sum',
        'sum_iva',
        'sum_all',
        'comments',
        'amount',
    ];

    public function bills()
    {
        return $this->belongsTo(Bill::class, 'id_bills');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_producto');
    }


}
