<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuctionDetail extends Model
{
    protected $fillable = ['auctionTitle', 'auctionDescription', 'publicationStatus', 'price'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
    public function auctionCategory() {
        return $this->hasOne(AuctionCategory::class);
    }
    
    public function auctionPlace() {
        return $this->hasOne(AuctionPlace::class);
    }
    
    public function auctionTime() {
        return $this->hasOne(AuctionTime::class);
    }
    
    public function auctionImage() {
        return $this->hasOne(AuctionImage::class);
    }
    
    public function sellerDetail() {
        return $this->hasOne(SellerDetail::class);
    }
    
    public function bids()
    {
        return $this->hasMany(Bid::class);
    }
    
}
