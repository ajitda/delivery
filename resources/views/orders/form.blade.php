@if(!empty($order))
<div class="modal-content" id="editOrder">
    {{ Form::model($order, array('route' => array('order.edit', $order->id), 'method' => 'POST', 'files' => true)) }}
@else
<div class="modal-content" id="addOrder">
    {{ Form::open(array('route' => 'order.create', 'files' => true,)) }}
@endif
    <div class="modal-header">
        <h4 class="modal-title">@if(!empty($order)) {{__('Edit Order')}} @else {{__('Add Order')}}@endif</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    </div>
    <div class="modal-body" >
        <div class="row">
            <div class="col-md-4" >
                <h4>Pickup Address</h4>
                <div class="form-group row">
                    <div class="col-sm-12">
                        {{ Form::text('name', null, array('class' => 'form-control', 'required', 'placeholder' => 'Name')) }}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        {{ Form::textarea('address', null, array('class' => 'form-control', 'required', 'rows'=>3, 'placeholder' => 'Address')) }}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        {{ Form::select('type',['pickup' => 'Pickup', 'delivery' => 'Delivery'], null, array('class' => 'form-control', 'required', 'placeholder' => 'Type')) }}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        {{ Form::text('phone', null, array('class' => 'form-control', 'required', 'placeholder' => 'Phone Number')) }}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        {{ Form::text('alt_phone', null, array('class' => 'form-control', 'required', 'placeholder' => 'Alternative Phone')) }}
                    </div>
                </div>
            </div>

            <div class="col-md-4" >
                <h4>Delivery Address</h4>
                <div class="form-group row">
                    <div class="col-sm-12">
                        {{ Form::text('name', null, array('class' => 'form-control', 'required', 'placeholder' => 'Name')) }}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        {{ Form::textarea('address', null, array('class' => 'form-control', 'required', 'rows'=>3, 'placeholder' => 'Address')) }}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        {{ Form::select('type',['pickup' => 'Pickup', 'delivery' => 'Delivery'], null, array('class' => 'form-control', 'required', 'placeholder' => 'Type')) }}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        {{ Form::text('phone', null, array('class' => 'form-control', 'required', 'placeholder' => 'Phone Number')) }}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        {{ Form::text('alt_phone', null, array('class' => 'form-control', 'required', 'placeholder' => 'Alternative Phone')) }}
                    </div>
                </div>
                
            </div>
            
            
            <div class="col-md-4">
                <h4>Product Information</h4>
                <div class="form-group row">
                    <div class="col-sm-12">
                        {{ Form::text('name', null, array('class' => 'form-control', 'required', 'placeholder' => 'Product Name')) }}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        {{ Form::text('size', null, array('class' => 'form-control', 'required', 'rows'=>3, 'placeholder' => 'Size')) }}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        {{ Form::text('weight', null, array('class' => 'form-control', 'required', 'placeholder' => 'Weight')) }}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        {{ Form::text('qty', null, array('class' => 'form-control', 'required', 'placeholder' => 'Quantity')) }}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        {{ Form::text('price', null, array('class' => 'form-control', 'required', 'placeholder' => 'Price')) }}
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
