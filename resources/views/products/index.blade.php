@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{__('Products')}}<a class="btn btn-small btn-success float-right" href="#addProductModal" data-toggle="modal"><i class="fa fa-plus"></i>&nbsp; {{__('Create Product')}}</a></div>

                <div class="card-body">
                    @include('products.table')
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade sub-modal" id="addProductModal">
    <div class="modal-dialog modal-md">
        @include('products.form', ['product'=>''])
    </div>
</div>
<div class="modal fade sub-modal" id="editProductModal">
    <div class="modal-dialog modal-md">
        <div class="modal-content" id="editProduct"></div>
    </div>
</div>
@endsection
