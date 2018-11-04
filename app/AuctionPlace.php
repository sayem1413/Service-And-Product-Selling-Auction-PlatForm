<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuctionPlace extends Model
{
    
    protected $fillable = [
        'division_id', 'district_id', 'upazila_id', 'user_id', 'auction_id',
    ];
    
    public function auctionDetail() {
        return $this->belongsTo(AuctionDetail::class);
    }
}
