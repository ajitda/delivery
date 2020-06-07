<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(Order $order, Company $company)
    {
        $this->order = $order;
        $this->company = $company;
    }

    public  function index()
    {
        $data['orders'] = $this->order->getAll(['paginate'=>5]);
        if (\request()->ajax()) {
            return $this->commonResponse($data, null, 'index');
        }
        $company = $this->company->currentCompany();
        $data['merchants'] = $company->merchants;
        $data['packages'] = $company->packages->pluck('name', 'id');
        // dd($data['merchants']);
        return view('orders.index', $data);
    }

    public function create()
    {
        $input = \request()->all();
        $input['user_id'] = auth()->user()->id;
        $input['company_id'] = session('company_id');
        $this->order->saveOrder($input, 'validation');
        $notify = 'Order added!';
        $company = $this->company->currentCompany();
        $data['merchants'] = $company->merchants;
        $data['packages'] = $company->packages->pluck('name', 'id');
        return $this->commonResponse($data, $notify, 'add');
    }

    public function edit(Request $request, $id)
    {
        $data['order'] = $this->order->getById($id);
        if ($request->isMethod('POST')) {
            $input = $request->all();
            $this->order->validator($input, 'edit')->validate();
            $input['user_id'] = $data['order']->user_id;
            $data['order'] = $this->order->saveOrder($input, ['id'=>$id]);
            $notify = 'Order updated!';
            return $this->commonResponse($data, $notify, 'update');
        }
        $company = $this->company->currentCompany();
        $data['merchants'] = $company->merchants;
        $data['packages'] = $company->packages->pluck('name', 'id');
        return $this->commonResponse($data, '', 'edit');
    }

    private function commonResponse($data=[], $notify = '', $option = null)
    {
        $response = $this->processNotification($notify);
        if ($option == 'add') {
            $data['order'] = [];
            $response['replaceWith']['#addOrder'] = view('orders.form', $data)->render();
        } else if ($option == 'edit' || $option == 'update') {
            $response['replaceWith']['#editOrder'] = view('orders.form', $data)->render();
        } else if ($option == 'show') {
            $response['replaceWith']['#showAccount'] = view('account.profile', $data)->render();
        }
        if ( $option == 'index' || $option == 'add' || $option == 'update' || $option == 'delete') {
            $data['orders'] = $this->order->getAll(['paginate'=>5]);
            $response['replaceWith']['#orderTable'] = view('orders.table', $data)->render();
        }
        return $this->sendViewResponse($response);
    }
}
