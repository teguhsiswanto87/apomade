<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SellingDetail extends Model
{
    protected $table = 'selling_details';

    protected $fillable = ['sellings_id', 'products_id', 'capital', 'selling_price', 'qty'];

    protected $hidden = [];

    // relation
    public function sellings()
    {
        $this->belongsTo(Selling::class);
    }

    public function products()
    {
        $this->belongsTo(Product::class);
    }

}
