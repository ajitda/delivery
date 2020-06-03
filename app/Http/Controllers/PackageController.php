<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function __construct(Package $package)
    {
        $this->package = $package;
    }

    public  function index()
    {
        
        $data['packages'] = $this->package->getAll(['paginate'=>5]);
        if (\request()->ajax()) {
            return $this->commonResponse($data, null, 'index');
        }
        return view('packages.index', $data);
    }

    public function create()
    {
        $input = \request()->all();
        $this->package->createPackage($input, 'validation');
        $notify = 'Package added!';
        return $this->commonResponse([], $notify, 'add');
    }

    public function edit(Request $request, $id)
    {
        $data['package'] = $this->package->getById($id);
        if ($request->isMethod('POST')) {
            $input = $request->all();
            $this->package->validator($input, 'edit')->validate();
            $input['user_id'] = $data['package']->user_id;
            $data['package'] = $this->package->savePackage($input, ['id'=>$id]);
            $notify = 'Package updated!';
            return $this->commonResponse($data, $notify, 'update');
        }
        return $this->commonResponse($data, '', 'edit');
    }

    private function commonResponse($data=[], $notify = '', $option = null)
    {
        $response = $this->processNotification($notify);
        if ($option == 'add') {
            $response['replaceWith']['#addPackage'] = view('packages.form', ['package'=>''])->render();
        } else if ($option == 'edit' || $option == 'update') {
            $response['replaceWith']['#editPackage'] = view('packages.form', $data)->render();
        } else if ($option == 'show') {
            $response['replaceWith']['#showAccount'] = view('account.profile', $data)->render();
        }
        if ( $option == 'index' || $option == 'add' || $option == 'update' || $option == 'delete') {
            $data['packages'] = $this->package->getAll(['paginate'=>5]);
            $response['replaceWith']['#packageTable'] = view('packages.table', $data)->render();
        }
        return $this->sendViewResponse($response);
    }
}
