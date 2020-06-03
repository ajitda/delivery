<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Contact extends Model
{
    protected $fillable = ['user_id', 'type', 'name', 'address', 'phone'];

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

    public function saveContact($input, $opt=null)
    {

        if(!empty($opt['id'])) {
            $contact = $this->getById($opt['id']);
        } else {
            $contact = new Contact();
        }

        $contact->user_id = $input['user_id'];
        $contact->type = $input['type'];
        $contact->name = $input['name'];
        $contact->address = $input['address'];
        $contact->phone = $input['phone'];
        $contact->alt_phone = $input['alt_phone'];
        $contact->save();
        return $contact;
    }

    public function validator(array $data, $opt=null)
    {
        $rules = [
            'user_id' => ['required', 'integer', 'max:255'],
            'type' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'min:11', 'max:11',],
            'phone' => ['string', 'min:11', 'max:11',],
        ];
        
        return Validator::make($data, $rules);
    }

    public function createContact($input, $opt=null)
    {
        

        if ($opt == 'validation') {
            $this->validator($input)->validate();
        }
        
        
        $input['user_id'] = $input['user_id'];
        $input['name'] = $input['name'];
        $input['type'] = $input['type'];
        $input['address'] = $input['address'];
        $input['phone'] = $input['phone'];
        $input['alt_phone'] = $input['alt_phone'];
        $contact = $this->saveContact($input);
        return $contact;
    }

    public function getById($id)
    {
        return $this->findOrFail($id);
    }  
}
