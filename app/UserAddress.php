<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    //
    
    protected $fillable = [
        'division_id', 'district_id', 'upazila_id', 'gpsLocation', 'dealingAddress', 'user_id',
    ];
    
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
