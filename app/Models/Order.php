<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillabe = ['pickup_contact_id', 'pickup_note', 'delivery_contact_id', ''];
}
