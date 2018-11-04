<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $fillable = ['division_id', 'districtName'];
    
    /**
     * Get the division for the Districts
     */
    
    public function division() {
        return $this->belongsTo(Division::class);
    }
    
    /**
     * Get the upazilas for the District
     */
    
    public function upazilas() {
        return $this->hasMany(Upazila::class);
    }
    
    public function auctionPlaces() {
        return $this->hasMany(AuctionPlace::class);
    }
}
