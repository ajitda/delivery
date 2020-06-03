@if(!empty($product))
<div class="modal-content" id="editProduct">
    {{ Form::model($product, array('route' => array('product.edit', $product->id), 'method' => 'POST', 'files' => true)) }}
@else
<div class="modal-content" id="addProduct">
    {{ Form::open(array('route' => 'product.create', 'files' => true,)) }}
@endif
    <div class="modal-header">
        <h4 class="modal-title">@if(!empty($product)) {{__('Edit Product')}} @else {{__('Add Product')}}@endif</h4>
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
                    {{ Form::label('description', __('Description') .' *',['class'=>'col-sm-3 text-right']) }}
                    <div class="col-sm-9">
                        {{ Form::textarea('description', null, array('class' => 'form-control', 'required', 'rows'=>3)) }}
                    </div>
                </div>
                <div class="form-group row">
                    {{ Form::label('price', __('Price') .' *',['class'=>'col-sm-3 text-right']) }}
                    <div class="col-sm-9">
                        {{ Form::text('price', null, array('class' => 'form-control', 'required')) }}
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
