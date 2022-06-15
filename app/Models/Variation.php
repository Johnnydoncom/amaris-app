<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variation extends Model
{
    use HasFactory;

    protected $fillable = ['name','regular_price','sales_price','quantity','product_id'];

    protected $appends = ['converted_price','price'];

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function getPriceAttribute(){
        return $this->sales_price > 0 ? $this->sales_price : $this->regular_price;
    }

    public function getConvertedPriceAttribute(){
        return currency($this->sales_price > 0 ? $this->sales_price : $this->regular_price, null, null, false);
    }
}
