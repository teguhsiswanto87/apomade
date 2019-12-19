<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = ['name', 'stock', 'capital', 'selling_price', 'gross_profit'];

    protected $hidden = ['created_at', 'updated_at'];

    // relation
    public function shoppingDetails()
    {
        return $this->hasMany(ShoppingDetail::class);
    }

    public function sellingDetails()
    {
        return $this->hasMany(SellingDetail::class);
    }

}
