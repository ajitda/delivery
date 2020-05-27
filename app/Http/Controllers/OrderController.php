<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function index()
    {
        // if()
        return $this->order->getAll();
    }

    public function create(Request $request)
    {
        //Validation by istiyak
        $input = $request->all();
        $valid = $this->validator($input);
        if($valid->fails()) {
           return $this->sendError($valid->errors());
        }

        
        $order = $this->order->createOrder($input);
        return $this->sendResponse($order);

        
    }


    protected function validator(array $data)
    {
        return Validator::make($data, [
            // Pickup validation

            'pickup_contact_id' => ['required', 'integer', 'max:255|min:1'],
            'pickup_note' => ['string', 'max:255|min:1'],
            'delivery_contact_id' => ['required', 'integer', 'max:255|min:1'],
            'delivery_note' => ['string', 'max:255|min:1'],
            'product_id' => ['required', 'integer', 'max:255|min:1'],
            'order_note' => ['string', 'max:255|min:1'],
            'status' => ['required', 'string', 'max:255|min:1'],
            'user_id' => ['required', 'integer', 'max:255|min:1'],

            
        ]);
    }


}
