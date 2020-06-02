<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Merchant;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MerchantController extends Controller
{
    public function __construct(Merchant $merchant)
    {
        $this->merchant = $merchant;
    }

    public function index()
    {
        $merchants = $this->merchant->getAll(['paginate'=>10]);
        return $this->sendResponse($merchants);
    }

    public function create(Request $request) {
        $input = $request->all();
        $valid = $this->merchant->validator($input);
        if($valid->fails()) {
           return $this->sendError($valid->errors());
        }
        $merchant = $this->merchant->createMerchant($input);
       return $this->sendResponse($merchant);
    }

    public function show($id){
        $single_data = Merchant::where('id', $id)->first();
        return $single_data;
    }

    public function edit(Request $request, Merchant $merchant) {
        if ($request->isMethod('POST')) {
            $input = $request->all();
            $valid = $this->merchant->validator($input, 'edit');
            if($valid->fails()) {
                return $this->sendError($valid->errors());
            }
            $merchant = $this->merchant->saveMerchant($input);
        }
        return $this->sendResponse($merchant);
    }

}
