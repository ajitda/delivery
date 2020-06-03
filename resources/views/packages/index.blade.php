@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{__('Packages')}}<a class="btn btn-small btn-success float-right" href="#addPackageModal" data-toggle="modal"><i class="fa fa-plus"></i>&nbsp; {{__('Create Package')}}</a></div>

                <div class="card-body">
                    @include('packages.table')
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade sub-modal" id="addPackageModal">
    <div class="modal-dialog modal-md">
        @include('packages.form', ['package'=>''])
    </div>
</div>
<div class="modal fade sub-modal" id="editPackageModal">
    <div class="modal-dialog modal-md">
        <div class="modal-content" id="editPackage"></div>
    </div>
</div>
@endsection
