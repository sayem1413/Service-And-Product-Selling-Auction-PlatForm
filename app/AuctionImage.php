<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuctionImage extends Model
{
   
    protected $fillable = [
        'user_id', 'auction_id',
    ];
    
    public function auctionDetail() {
        return $this->belongsTo(AuctionDetail::class);
    }
}
