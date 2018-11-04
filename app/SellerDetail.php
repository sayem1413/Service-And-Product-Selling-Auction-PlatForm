<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SellerDetail extends Model
{
    protected $fillable = ['phoneNumber'];
    
    
    public function auctionDetails() {
        return $this->belongsTo(AuctionDetail::class);
    }
    
    public function user() {
        return $this->belongsTo(User::class);
    }
}
