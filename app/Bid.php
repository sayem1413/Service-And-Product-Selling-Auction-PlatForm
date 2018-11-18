<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    protected $fillable = [
        'price',
    ];
    
    public function user()
    {
        return $this->belongsTo(Bid::class);
    }
    
    public function auctionDetail()
    {
        return $this->belongsTo(AuctionDetail::class);
    }
    
}
