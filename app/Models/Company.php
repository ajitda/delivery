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

    public function currentCompany()
    {
        return $this->findOrFail(session('company_id'));
    }

    public function merchants()
    {
        return $this->hasMany('App\Models\Merchant');
    }

    public function packages()
    {
        return $this->hasMany('App\Models\Package');
    }
}
