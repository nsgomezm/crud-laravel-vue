<?php

namespace App\Models;

use App\Models\User;
use App\Models\Shopping;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bill extends Model
{
    use HasFactory;

    public function shoppings()
    {
        return $this->hasMany(Shopping::class, 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
