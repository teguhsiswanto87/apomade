<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Selling extends Model
{
    protected $table = "sellings";

    protected $fillable = [
        'id',
        'market_places_id',
        'couriers_id',
        'purchase_date',
        'buyers_name',
        'shipping_tax',
        'voucher_discount',
        'turnover',
        'profit',
        'selling_status',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [];

    // relation
    public function sellingDetails()
    {
        return $this->hasMany(SellingDetail::class);
    }

    public function marketPlaces()
    {
        return $this->belongsTo(MarketPlace::class);
    }

    public function couriers()
    {
        return $this->belongsTo(Courier::class);
    }


}
