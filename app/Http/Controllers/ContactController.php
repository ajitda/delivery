<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    public  function index()
    {
        
        $data['contacts'] = $this->contact->getAll(['paginate'=>5]);
        if (\request()->ajax()) {
            return $this->commonResponse($data, null, 'index');
        }
        return view('contacts.index', $data);
    }

    public function create()
    {
        $input = \request()->all();
        $input['user_id'] = Auth::user()->id;
        $this->contact->createContact($input, 'validation');
        $notify = 'Contact added!';
        return $this->commonResponse([], $notify, 'add');
    }

    public function edit(Request $request, $id)
    {
        $data['contact'] = $this->contact->getById($id);
        if ($request->isMethod('POST')) {
            $input = $request->all();
            $input['user_id'] = Auth::user()->id;
            $this->contact->validator($input, 'edit')->validate();
            $input['user_id'] = $data['contact']->user_id;
            $data['contact'] = $this->contact->saveContact($input, ['id'=>$id]);
            $notify = 'Contact updated!';
            return $this->commonResponse($data, $notify, 'update');
        }
        return $this->commonResponse($data, '', 'edit');
    }

    private function commonResponse($data=[], $notify = '', $option = null)
    {
        $response = $this->processNotification($notify);
        if ($option == 'add') {
            $response['replaceWith']['#addContact'] = view('contacts.form', ['contact'=>''])->render();
        } else if ($option == 'edit' || $option == 'update') {
            $response['replaceWith']['#editContact'] = view('contacts.form', $data)->render();
        } else if ($option == 'show') {
            $response['replaceWith']['#showAccount'] = view('account.profile', $data)->render();
        }
        if ( $option == 'index' || $option == 'add' || $option == 'update' || $option == 'delete') {
            $data['contacts'] = $this->contact->getAll(['paginate'=>5]);
            $response['replaceWith']['#contactTable'] = view('contacts.table', $data)->render();
        }
        return $this->sendViewResponse($response);
    }
}
