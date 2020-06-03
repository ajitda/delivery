<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Product extends Model
{
    // protected $guarded = []; 
    protected $fillable = ['name', 'size', 'weight', 'qty', 'price'];


    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }

    public function getAll($opt=null)
    {
        $result =  $this;
        if (!empty($opt['paginate'])) {
            $result = $result->paginate($opt['paginate']);
        } else {
            $result = $result->get();
        }
        return $result;
    }

    public function saveProduct($input, $opt=null)
    {
        if(!empty($opt['id'])) {
            $product = $this->getById($opt['id']);
        } else {
            $product = new Product();
        }

        $product->name = $input['name'];
        $product->size = $input['size'];
        $product->weight = $input['weight'];
        $product->qty = $input['qty'];
        $product->price = $input['price'];
        $product->save();
        return $product;
    }

    public function validator(array $data, $opt= null)
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'size' => ['required', 'string', 'max:255'],
            'weight' => ['required', 'string', 'max:20'],
            'qty' => ['required', 'string', 'max:20'],
            'price' => ['required', 'string', 'max:255'],
        ];
        
        return Validator::make($data, $rules);
    }

    public function createProduct($input, $opt=null)
    {
        if ($opt == 'validation') {
            $this->validator($input)->validate();
        }
        $product = $this->saveProduct($input);
        return $product;
    }

    public function getById($id)
    {
        return $this->findOrFail($id);
    }
}
