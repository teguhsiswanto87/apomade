<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShoppingDetail extends Model
{

    protected $table = 'shopping_details';

    protected $primaryKey = ['shoppings_id', 'products_id'];

    protected $fillable = ['shoppings_id', 'products_id', 'price', 'qty'];

    protected $hidden = ['created_at', 'updated_at'];


    // relation
    public function shoppings()
    {
        return $this->belongsTo(Shopping::class);
    }

    public function products()
    {
        return $this->belongsTo(Product::class);
    }

}
