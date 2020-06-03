<?php

namespace App\Models;

use App\Models\Package;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    // protected $guarded = []; 
    protected $fillable = ['name', 'description', 'charge'];


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

    public function savePackage($input, $opt=null)
    {
        if(!empty($opt['id'])) {
            $package = $this->getById($opt['id']);
        } else {
            $package = new Package();
        }

        $package->name = $input['name'];
        $package->description = $input['description'];
        $package->price = $input['price'];
        $package->save();
        return $package;
    }

    public function validator(array $data, $opt= null)
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'price' => ['required', 'string', 'max:20'],
        ];
        
        return Validator::make($data, $rules);
    }

    public function createPackage($input, $opt=null)
    {
        
        if ($opt == 'validation') {
            $this->validator($input)->validate();
        }
        $package = $this->savePackage($input);
        return $package;
    }

    public function getById($id)
    {
        return $this->findOrFail($id);
    }
}
