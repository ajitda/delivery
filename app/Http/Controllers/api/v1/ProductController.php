<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        return Product::all();
    }

    public function create(Request $request) {
        $input = $request->all();
        $valid = $this->validator($input);
        if($valid->fails()) {
           return $this->sendError($valid->errors());
        }

        $contact = Product::create($input);


       return $this->sendResponse($contact);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [

            'name' => ['required', 'string', 'max:255'],
            'size' => ['required', 'string', 'max:255'],
            'weight' => ['required', 'string', 'max:255'],
            'qty' => ['required', 'string', 'max:255'],
            'price' => ['required', 'string', 'max:255'],

        ]);
    }
}
