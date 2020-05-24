<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $guarded = [];   

    public function users()
    {
        return $this->morphedByMany('App\User', 'user', 'user_companies', 'company_id', 'user_id');
    }

    // public function user(): BelongsToMany
    // {
    //     return $this->belongsToMany(
    //         'App\User',
    //         'user_companies',
    //         'company_id',
    //         'user_id'
    //     );
    // }
}
