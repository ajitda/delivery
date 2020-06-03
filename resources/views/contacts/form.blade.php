@if(!empty($contact))
<div class="modal-content" id="editContact">
    {{ Form::model($contact, array('route' => array('contact.edit', $contact->id), 'method' => 'POST', 'files' => true)) }}
@else
<div class="modal-content" id="addContact">
    {{ Form::open(array('route' => 'contact.create', 'files' => true,)) }}
@endif
    <div class="modal-header">
        <h4 class="modal-title">@if(!empty($contact)) {{__('Edit Contact')}} @else {{__('Add Contact')}}@endif</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    </div>
    <div class="modal-body" >
        <div class="row">
            <div class="col-md-12" >
                <div class="form-group row">
                    {{ Form::label('name', __('Name') .' *',['class'=>'col-sm-3 text-right']) }}
                    <div class="col-sm-9">
                        {{ Form::text('name', null, array('class' => 'form-control', 'required')) }}
                    </div>
                </div>
                <div class="form-group row">
                    {{ Form::label('address', __('Address') .' *',['class'=>'col-sm-3 text-right']) }}
                    <div class="col-sm-9">
                        {{ Form::textarea('address', null, array('class' => 'form-control', 'required', 'rows'=>3)) }}
                    </div>
                </div>
                <div class="form-group row">
                    {{ Form::label('type', __('Type') .' *',['class'=>'col-sm-3 text-right']) }}
                    <div class="col-sm-9">
                        {{ Form::select('type',['pickup' => 'Pickup', 'delivery' => 'Delivery'], null, array('class' => 'form-control', 'required')) }}
                    </div>
                </div>
                <div class="form-group row">
                    {{ Form::label('phone', __('Phone Number') .' *',['class'=>'col-sm-3 text-right']) }}
                    <div class="col-sm-9">
                        {{ Form::text('phone', null, array('class' => 'form-control', 'required')) }}
                    </div>
                </div>
                <div class="form-group row">
                    {{ Form::label('alt_phone', __('Alt Number') .' ',['class'=>'col-sm-3 text-right']) }}
                    <div class="col-sm-9">
                        {{ Form::text('alt_phone', null, array('class' => 'form-control', 'required')) }}
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
