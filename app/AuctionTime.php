<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuctionTime extends Model
{
    
    
    public function auctionDetail() {
        return $this->belongsTo(AuctionDetail::class);
    }
}
