<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Merchant;
use App\Models\Product;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\AssignOp\Concat;

class MerchantController extends Controller
{
    public function __construct(Merchant $merchant, Contact $contact, Product $product)
    {
        $this->merchant = $merchant;
        $this->contact = $contact;
        $this->product = $product;
    }

    public  function index()
    {
        $data['merchants'] = $this->merchant->getAll(['paginate'=>5]);
        if (\request()->ajax()) {
            return $this->commonResponse($data, null, 'index');
        }
        return view('merchants.index', $data);
    }

    public function create()
    {
        $input = \request()->all();
        $this->merchant->createMerchant($input, 'validation');
        $notify = 'Merchant added!';
        return $this->commonResponse([], $notify, 'add');
    }

    public function edit(Request $request, $id)
    {
        $data['merchant'] = $this->merchant->getById($id);
        if ($request->isMethod('POST')) {
            $input = $request->all();
            $this->merchant->validator($input, 'edit')->validate();
            $input['user_id'] = $data['merchant']->user_id;
            $data['merchant'] = $this->merchant->saveMerchant($input, ['id'=>$id]);
            $notify = 'Merchant updated!';
            return $this->commonResponse($data, $notify, 'update');
        }
        return $this->commonResponse($data, '', 'edit');
    }

    public function getContactsProducts(Merchant $merchant)
    {
        $data['contacts'] = $merchant->contacts;
        $data['products'] = $merchant->products;
        // dd($merchant);
        $response['replaceWith']['#orderProductContact'] = view('orders.partials.contact_product', $data)->render();
        return $this->sendViewResponse($response);
    }

    private function commonResponse($data=[], $notify = '', $option = null)
    {
        $response = $this->processNotification($notify);
        if ($option == 'add') {
            $response['replaceWith']['#addMerchant'] = view('merchants.form', ['merchant'=>''])->render();
        } else if ($option == 'edit' || $option == 'update') {
            $response['replaceWith']['#editMerchant'] = view('merchants.form', $data)->render();
        } else if ($option == 'show') {
            $response['replaceWith']['#showAccount'] = view('account.profile', $data)->render();
        }
        if ( $option == 'index' || $option == 'add' || $option == 'update' || $option == 'delete') {
            $data['merchants'] = $this->merchant->getAll(['paginate'=>5]);
            $response['replaceWith']['#merchantTable'] = view('merchants.table', $data)->render();
        }
        return $this->sendViewResponse($response);
    }
}
