<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MarketPlace extends Model
{
    protected $table = 'market_places';

    protected $fillable = ['id', 'name', 'image_link', 'store_link', 'active'];

    protected $hidden = [];

    public $timestamps = false;

    // relation
    public function sellings()
    {
        return $this->hasMany(Selling::class);
    }

}
