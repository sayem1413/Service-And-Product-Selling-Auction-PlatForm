<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['categoryName', 'categoryDescription', 'publicationStatus'];
    
    
    /**
     * Get the sub-categories for the category
     */
    
    public function subCategories() {
        return $this->hasMany(SubCategory::class);
    }
    
    public function auctionCategories() {
        return $this->hasMany(AuctionCategory::class);
    }
    
}
