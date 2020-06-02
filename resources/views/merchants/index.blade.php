@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{__('Merchants')}}<a class="btn btn-small btn-success float-right" href="#addMerchantModal" data-toggle="modal"><i class="fa fa-plus"></i>&nbsp; {{__('Create Merchant')}}</a></div>

                <div class="card-body">
                    @include('merchants.table')
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade sub-modal" id="addMerchantModal">
    <div class="modal-dialog modal-lg">
        @include('merchants.form', ['merchant'=>''])
    </div>
</div>
<div class="modal fade sub-modal" id="editMerchantModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="editMerchant"></div>
    </div>
</div>
@endsection
