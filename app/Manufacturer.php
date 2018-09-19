<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    protected $fillable = ['manufacturerName', 'publicationStatus'];
    
    /**
     * Get the category for the  sub-category
     */
    
    public function subCategories() {
        return $this->belongsToMany(SubCategory::class)->using(SubcategoryManufacturer::class);
    }
}
