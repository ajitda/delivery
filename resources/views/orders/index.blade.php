@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{__('Orders')}}<a class="btn btn-small btn-success float-right" href="#addOrderModal" data-toggle="modal"><i class="fa fa-plus"></i>&nbsp; {{__('Create Order')}}</a></div>

                <div class="card-body">
                    @include('orders.table')
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade sub-modal" id="addOrderModal">
    <div class="modal-dialog modal-lg">
        @include('orders.form', ['order'=>''])
    </div>
</div>
<div class="modal fade sub-modal" id="editOrderModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="editOrder"></div>
    </div>
</div>
<div class="modal fade sub-modal" id="addContactModal">
    <div class="modal-dialog modal-md">
        @include('contacts.form', ['contact'=>''])
    </div>
</div>
<div class="modal fade sub-modal" id="addProductModal">
    <div class="modal-dialog modal-md">
        @include('products.form', ['product'=>''])
    </div>
</div>
@endsection
