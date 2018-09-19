<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $fillable = ['subCategoryName', 'category_id', 'publicationStatus'];
    
    /**
     * Get the category for the  sub-category
     */
    
    public function category() {
        return $this->belongsTo(Category::class);
    }
    
    public function manufacturers() {
        return $this->belongsToMany(Manufacturer::class)->using(SubcategoryManufacturer::class);
    }
}
