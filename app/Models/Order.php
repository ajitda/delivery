<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];  

    public function getAll($option=null)
    {
        $this->all();
    }

    public function createOrder($input)
    {
        $this->create($input);
    }
}
