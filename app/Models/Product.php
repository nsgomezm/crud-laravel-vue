<?php

namespace App\Models;

use App\Models\Shopping;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'stock',
        'price',
        'descript',
    ];

    public function shoppings()
    {
        return $this->hasMany(Shopping::class, 'id_producto');
    }
}
