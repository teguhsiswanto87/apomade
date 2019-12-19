<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Courier extends Model
{
    protected $table = 'couriers';

    protected $fillable = ['id', 'name', 'image_link', 'active'];

    protected $hidden = [];

    public $timestamps = false;

    // relation
    public function sellings()
    {
        return $this->hasMany(Selling::class);
    }
}
