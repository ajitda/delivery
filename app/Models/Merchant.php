<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Merchant extends Model
{
    protected $fillable = ['first_name', 'last_name', 'date_of_birth', 'document_no', 'phone', 'address', 'user_id'];

    public function user() {
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

    public function saveMerchant($input, $opt=null)
    {
        if(!empty($opt['id'])) {
            $merchant = $this->getById($opt['id']);
        } else {
            $merchant = new Merchant();
        }
        $merchant->first_name = $input['first_name'];
        $merchant->last_name = $input['last_name'];
        $merchant->date_of_birth = $input['date_of_birth'];
        $merchant->phone = $input['phone'];
        $merchant->document_no = !empty($input['document_no']) ? $input['document_no'] : '';
        $merchant->address = $input['address'];
        $merchant->user_id = $input['user_id'];
        $merchant->company_id = session('company_id');
        $merchant->save();
        return $merchant;
    }

    public function validator(array $data, $opt= null)
    {
        $rules = [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'date_of_birth' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string', 'max:255'],
            'document_no' => ['required', 'string', 'max:30'],
        ];
        if ($opt != 'edit') {
            $rules['email'] = ['required', 'string', 'email', 'max:255', 'unique:users'];
            $rules['password'] = ['required', 'string', 'min:8', 'confirmed'];
        }
        return Validator::make($data, $rules);
    }

    public function createMerchant($input, $opt=null)
    {
        if ($opt == 'validation') {
            $this->validator($input)->validate();
        }
        $input['name'] = $input['first_name'].' '.$input['last_name'];
        $company = auth()->user()->companies;
        //Create User
        $input['name'] = $input['first_name'].' '.$input['last_name'];
        $user= (new User())->saveUser($input);
        // Create User Company
        $user->companies()->attach($company[0]);
        // Create Merchant
        $input['user_id'] = $user->id;
        $merchant = $this->saveMerchant($input);
        $user->assignRole(config('delivery.roles.merchant'));
        return $merchant;
    }

    public function getById($id)
    {
        return $this->findOrFail($id);
    }

    public function contacts()
    {
        return $this->hasMany('App\Models\Contact');
    }

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }
}
