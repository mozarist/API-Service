<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $fillable = [
        "sku",
        "name",
        "brand",
        "price",
        "stock",
        "category"
    ];
}
