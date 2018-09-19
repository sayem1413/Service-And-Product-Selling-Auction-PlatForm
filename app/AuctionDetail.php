<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuctionDetail extends Model
{
    protected $fillable = ['auctionTitle', 'auctionDescription', 'publicationStatus', 'price'];
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
