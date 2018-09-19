<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    
    protected $fillable = [
        'commentBody',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function auctionDetail()
    {
        return $this->belongsTo(AuctionDetail::class);
    }
    
}
