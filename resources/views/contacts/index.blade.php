@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{__('Contacts')}}<a class="btn btn-small btn-success float-right" href="#addContactModal" data-toggle="modal"><i class="fa fa-plus"></i>&nbsp; {{__('Create Contact')}}</a></div>

                <div class="card-body">
                    @include('contacts.table')
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade sub-modal" id="addContactModal">
    <div class="modal-dialog modal-md">
        @include('contacts.form', ['contact'=>''])
    </div>
</div>
<div class="modal fade sub-modal" id="editContactModal">
    <div class="modal-dialog modal-md">
        <div class="modal-content" id="editContact"></div>
    </div>
</div>
@endsection
