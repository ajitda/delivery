<?php

namespace App\Http\Controllers;

use App\Jobs\CreateCompany;
use App\Models\Company;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    public function index()
    {
        return Company::all();
    }

    public function create(Request $request) {
        $input = $request->all();
        $valid = $this->validator($input);
        if($valid->fails()) {
           return $this->sendError($valid->errors());
        }
        $user = (new User())->saveUser($input);
        $company = $user->companies()->create(['name'=>$input['name'], 'domain'=>$input['domain']]);
        $user->assignRole(config('delivery.roles.company'));
       return $this->sendResponse($user);
    }

    public function edit(Request $request, Company $company) {
        if ($request->isMethod('POST')) {
            $company->update($request->all());
        }
        return $company;
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }
}