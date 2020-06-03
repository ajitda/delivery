@if(!empty($merchant))
<div class="modal-content" id="editMerchant">
    {{ Form::model($merchant, array('route' => array('merchant.edit', $merchant->id), 'method' => 'POST', 'files' => true)) }}
@else
<div class="modal-content" id="addMerchant">
    {{ Form::open(array('route' => 'merchant.create', 'files' => true,)) }}
@endif
    <div class="modal-header">
        <h4 class="modal-title">@if(!empty($merchant)) {{__('Edit Merchant')}} @else {{__('Add Merchant')}}@endif</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    </div>
    <div class="modal-body" >
        <div class="row">
            <div class="col-md-6" >
                <div class="form-group row">
                    {{ Form::label('first_name', __('First Name') .' *',['class'=>'col-sm-3 text-right']) }}
                    <div class="col-sm-9">
                        {{ Form::text('first_name', null, array('class' => 'form-control', 'required')) }}
                    </div>
                </div>
                <div class="form-group row">
                    {{ Form::label('last_name', __('Last Name') .' *',['class'=>'col-sm-3 text-right']) }}
                    <div class="col-sm-9">
                        {{ Form::text('last_name', null, array('class' => 'form-control', 'required')) }}
                    </div>
                </div>
                @empty($merchant)
                <div class="form-group row">
                    {{ Form::label('email', __('Email') .' *',['class'=>'col-sm-3 text-right']) }}
                    <div class="col-sm-9">
                        {{ Form::email('email', null, array('class' => 'form-control', 'required')) }}
                    </div>
                </div>
                <div class="form-group row">
                    {{ Form::label('password', __('Password') .' *',['class'=>'col-sm-3 text-right']) }}
                    <div class="col-sm-9">
                        {{ Form::password('password', array('class' => 'form-control', 'required')) }}
                    </div>
                </div>
                <div class="form-group row">
                    {{ Form::label('password_confirmation', __('Confirm Password') .' *',['class'=>'col-sm-3 text-right']) }}
                    <div class="col-sm-9">
                        {{ Form::password('password_confirmation', array('class' => 'form-control', 'required')) }}
                    </div>
                </div>
                @endif
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    {{ Form::label('date_of_birth', __('Date of Birth').' *',['class'=>'col-sm-3 text-right']) }}
                    <div class="col-sm-9">
                        {{ Form::date('date_of_birth', null, array('class' => 'form-control', 'required')) }}
                    </div>
                </div>
                <div class="form-group row">
                    {{ Form::label('address', __('Address'),['class'=>'col-sm-3 text-right']) }}
                    <div class="col-sm-9">
                        {{ Form::textarea('address', null, array('class'=>'form-control', 'rows' =>'3')) }}
                    </div>
                </div>
                <div class="form-group row">
                    {{ Form::label('document_no', __('Document No'),['class'=>'col-sm-3 text-right']) }}
                    <div class="col-sm-9">
                        {{ Form::number('document_no', null, array('class' => 'form-control')) }}
                    </div>
                </div>
                <div class="form-group row">
                    {{ Form::label('phone', __('Phone'), ['class'=>'col-sm-3 text-right']) }}
                    <div class="col-sm-9">
                        {{ Form::text('phone', null, array('class' => 'form-control')) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        {{ Form::submit(__('Submit'), array('class' => 'btn btn-success')) }}
        <button type="button" class="btn btn-default" data-dismiss="modal">{{__('Close')}}</button>
    </div>
    {{ Form::close() }}
</div>
