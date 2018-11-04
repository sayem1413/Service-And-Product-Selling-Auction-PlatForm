<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    protected $fillable = ['divisionName'];
    
    /**
     * Get the districts for the division
     */
    
    public function districts() {
        return $this->hasMany(District::class);
    }
    
    public function auctionPlaces() {
        return $this->hasMany(AuctionPlace::class);
    }
    
}
