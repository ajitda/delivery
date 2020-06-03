<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public  function index()
    {
        
        $data['products'] = $this->product->getAll(['paginate'=>5]);
        if (\request()->ajax()) {
            return $this->commonResponse($data, null, 'index');
        }
        return view('products.index', $data);
    }

    public function create()
    {
        $input = \request()->all();
        $this->product->createProduct($input, 'validation');
        $notify = 'Product added!';
        return $this->commonResponse([], $notify, 'add');
    }

    public function edit(Request $request, $id)
    {
        $data['product'] = $this->product->getById($id);
        if ($request->isMethod('POST')) {
            $input = $request->all();
            $this->product->validator($input, 'edit')->validate();
            $input['user_id'] = $data['product']->user_id;
            $data['product'] = $this->product->saveProduct($input, ['id'=>$id]);
            $notify = 'Product updated!';
            return $this->commonResponse($data, $notify, 'update');
        }
        return $this->commonResponse($data, '', 'edit');
    }

    private function commonResponse($data=[], $notify = '', $option = null)
    {
        $response = $this->processNotification($notify);
        if ($option == 'add') {
            $response['replaceWith']['#addProduct'] = view('products.form', ['product'=>''])->render();
        } else if ($option == 'edit' || $option == 'update') {
            $response['replaceWith']['#editProduct'] = view('products.form', $data)->render();
        } else if ($option == 'show') {
            $response['replaceWith']['#showAccount'] = view('account.profile', $data)->render();
        }
        if ( $option == 'index' || $option == 'add' || $option == 'update' || $option == 'delete') {
            $data['products'] = $this->product->getAll(['paginate'=>5]);
            $response['replaceWith']['#productTable'] = view('products.table', $data)->render();
        }
        return $this->sendViewResponse($response);
    }
}
