<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CardInfo extends Model
{
    protected $fillable = [
        'cardNumber', 'cvv', 'expirationDate',
    ];
    
    public function user()
    {
        return $this->belongsTo(CardInfo::class);
    }
    
}
