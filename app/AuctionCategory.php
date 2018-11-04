<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuctionCategory extends Model
{
    
    protected $fillable = [
        'category_id', 'subcategory_id', 'user_id', 'auction_id',
    ];
    
    public function auctionDetail() {
        return $this->belongsTo(AuctionDetail::class);
    }
}
