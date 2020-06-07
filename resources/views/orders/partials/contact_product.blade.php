<div id="orderProductContact">
    <div class="form-group row">
        {{ Form::label('pickup_contact_id', __('Pickup Contact') .' *',['class'=>'col-sm-3 text-right']) }}
        <div class="col-sm-8">
            <select name="pickup_contact_id" id="pickup_contact_id" class="form-control">
                <option value="">Select Pickup Address</option>
                @foreach($contacts as $contact) 
                <option value="{{$contact->id}}">{{$contact->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-1"><a class="btn btn-small btn-success float-right" href="#addContactModal" data-toggle="modal"><i class="fa fa-plus"></i></a></div>
    </div>
    <div class="form-group row">
        {{ Form::label('delivery_contact_id', __('Delivery Contact') .' *',['class'=>'col-sm-3 text-right']) }}
        <div class="col-sm-8">
            <select name="delivery_contact_id" id="delivery_contact_id" class="form-control">
                <option value="">Select Delivery Address</option>
                @foreach($contacts as $contact) 
                <option value="{{$contact->id}}">{{$contact->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-1"><a class="btn btn-small btn-success float-right" href="#addContactModal" data-toggle="modal"><i class="fa fa-plus"></i></a></div>
    </div>
    <div class="form-group row">
        {{ Form::label('product_id', __('Product') .' *',['class'=>'col-sm-3 text-right']) }}
        <div class="col-sm-8">
            <select name="product_id" id="product_id" class="form-control">
                <option value="">Select Product</option>
                @foreach($products as $product) 
                <option value="{{$product->id}}">{{$product->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-1">
            <a class="btn btn-small btn-success float-right" href="#addProductModal" data-toggle="modal"><i class="fa fa-plus"></i></a>
        </div>
        
    </div>
</div>