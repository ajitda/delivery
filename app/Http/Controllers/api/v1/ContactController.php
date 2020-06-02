<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Contacts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function index()
    {
        return Contacts::all();
    }

    public function create(Request $request) {
        $input = $request->all();
        $valid = $this->validator($input);
        if($valid->fails()) {
           return $this->sendError($valid->errors());
        }

        $contact = Contacts::create($input);


       return $this->sendResponse($contact);
    }




    protected function validator(array $data)
    {
        return Validator::make($data, [
            'type' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
        ]);
    }
}
