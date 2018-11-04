<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Upazila extends Model
{
    protected $fillable = ['district_id', 'upazilaName'];
    
    /**
     * Get the district for the upazilas
     */
    
    public function district() {
        return $this->belongsTo(District::class);
    }
    
    public function auctionPlaces() {
        return $this->belongsTo(AuctionPlace::class);
    }
    
}
