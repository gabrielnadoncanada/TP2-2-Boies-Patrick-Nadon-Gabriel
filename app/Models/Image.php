<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable =[
        'name', 'user_id', 'location_id',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function scopeAllUser($query)
    // {
    //     $user = auth()->user();
        
    //     return $query->with ('user')->latest ();
       
    // }

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('alert')->withTimestamps();
    }
}
