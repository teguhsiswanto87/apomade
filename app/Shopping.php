<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shopping extends Model
{
    protected $table = 'shoppings';

    protected $fillable = ['id', 'users_id', 'shopping_date', 'total_price'];

    protected $hidden = ['created_at', 'updated_at'];

    // relation
    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function shoppingDetails()
    {
        return $this->hasMany(ShoppingDetail::class);
    }

}
