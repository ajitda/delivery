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
        
        <div class="form-group row">
            {{ Form::label('merchant_id', __('Merchant') .' *',['class'=>'col-sm-3 text-right']) }}
            <div class="col-sm-9">
                <select name="merchant_id" class="form-control" id="merchant_id" onchange="getContactProduct()">
                    <option value="">Select Merchant</option>
                    @foreach($merchants as $merchant) 
                    <option value="{{ $merchant->id}}">
                   {{$merchant->first_name." ".$merchant->last_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div id="orderProductContact">
        </div>

        <div class="form-group row">
            {{ Form::label('pickup_note', __('Pickup Note') .' *',['class'=>'col-sm-3 text-right']) }}
            <div class="col-sm-9">
                {{ Form::text('pickup_note', null, array('class' => 'form-control', 'required', 'placeholder' => 'Pickup Note')) }}
            </div>
        </div>
        <div class="form-group row">
            {{ Form::label('delivery_note', __('Delivery Note') .' *',['class'=>'col-sm-3 text-right']) }}
            <div class="col-sm-9">
                {{ Form::text('delivery_note', null, array('class' => 'form-control', 'required', 'placeholder' => 'Delivery Note')) }}
            </div>
        </div>
        <div class="form-group row">
            {{ Form::label('order_note', __('Order Note') .' *',['class'=>'col-sm-3 text-right']) }}
            <div class="col-sm-9">
                {{ Form::text('order_note', null, array('class' => 'form-control', 'required', 'placeholder' => 'Order Note')) }}
            </div>
        </div>

        <div class="form-group row">
            {{ Form::label('package_id', __('Package') .' *',['class'=>'col-sm-3 text-right']) }}
            <div class="col-sm-9">
                {{Form::select('package_id', $packages, null, ['class'=>'form-control'])}}
            </div>
        </div>

    </div>
    <div class="modal-footer">
        {{ Form::submit(__('Submit'), array('class' => 'btn btn-success')) }}
        <button type="button" class="btn btn-default" data-dismiss="modal">{{__('Close')}}</button>
    </div>
    {{ Form::close() }}
    <form action="" id="getContactProduct" method="GET">
        @csrf
    </form>
</div>
<script>
    function getContactProduct() {
        var merchant_id = $("#merchant_id").val();
        var url = "{{url('merchant')}}/"+merchant_id+"/contacts_products"
        var form = $("#getContactProduct").attr('action', url);
        form.submit();
    }
</script>