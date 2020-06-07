<?php

namespace App\Models;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['pickup_contact_id', 'pickup_note', 'delivery_contact_id', 'delivery_note', 'product_id', 'order_note', 'status','user_id', 'merchant_id'];


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

    public function saveOrder($input, $opt=null)
    {
        if(!empty($opt['id'])) {
            $order = $this->getById($opt['id']);
        } else {
            $order = new Order();
        }
        $order->pickup_contact_id = $input['pickup_contact_id'];
        $order->pickup_note = $input['pickup_note'];

        $order->delivery_contact_id = $input['delivery_contact_id'];
        $order->delivery_note = $input['delivery_note'];

        $order->product_id = $input['product_id'];
        $order->order_note = $input['order_note'];

        $order->status = config('delivery.order_status.created');
        $order->package_id = $input['package_id'];

        $order->user_id = $input['user_id'];
        $order->merchant_id = $input['merchant_id'];
        $order->company_id = $input['company_id'];
        $order->save();
        return $order;
    }

    public function validator(array $data, $opt= null)
    {
        $rules = [
            'pickup_contact_id' => ['required', 'integer'],
            'delivery_contact_id' => ['required', 'integer'],
            'product_id' => ['required', 'integer'],
            'merchant_id' => ['required', 'integer'],
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
}
