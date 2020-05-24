<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
    protected $fillable = ['first_name', 'last_name', 'date_of_birth', 'document_no', 'phone', 'address', 'user_id'];

    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }
}
