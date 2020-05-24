<?php

namespace App\Http\Controllers;

use App\Models\Merchant;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MerchantController extends Controller
{
    public function index()
    {
        return Merchant::all();
    }

    public function create(Request $request) {
        $input = $request->all();
        $valid = $this->validator($input);
        if($valid->fails()) {
           return $this->sendError($valid->errors());
        }
        $company = auth()->user()->companies;
        // dd($company[0]);
        $input['name'] = $input['first_name'].' '.$input['last_name'];
        $user= (new User())->saveUser($input);
         $user->companies()->attach($company[0]);
        // $company = $user->companies()->create(['name'=>$input['name'], 'domain'=>$input['domain']]);
        $input['user_id'] = $user->id;
        $merchant = Merchant::create($input);
        $user->assignRole(config('delivery.roles.merchant'));
       return $this->sendResponse($user);
    }

    public function edit(Request $request, Merchant $merchant) {
        if ($request->isMethod('POST')) {
            $merchant->update($request->all());
        }
        return $merchant;
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'date_of_birth' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string', 'max:255'],
            'document_no' => ['required', 'string', 'max:30'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }
}
