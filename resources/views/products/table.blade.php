<div id="productTable">
    <table class="table table-hover table-striped table-success">
        <thead>
            <tr>
                <th>Name</th>
                <th>Size</th>
                <th>Weight</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $value)
            <tr>
                <td>{{$value->name}}</td>
                <td>{{$value->size}}</td>
                <td>{{$value->weight}}</td>
                <td>{{$value->qty}}</td>
                <td>{{$value->price}}</td>
                <td>
                @php
                    $actions = [
                      //['data-replace'=>'#showCustomer','url'=>'#showCustomerModal','ajax-url'=>url('customers/' . $value->id . '/'), 'name'=>'View Profile', 'icon'=>'eye'],
                      ['data-replace'=>'#editProduct', 'url'=>'#editProductModal','ajax-url'=>url('product/'.$value->id.'/edit'), 'name'=>__('Edit'), 'icon'=>'pencil-alt'],
                      //['url'=>'merchant/' . $value->id,'name'=>'delete']
                      ];
                @endphp
                @include('includes.actions', ['actions'=>$actions])
                </td>
            </tr>
             @endforeach
        </tbody>
    </table>
    @include('includes.pagination', ['items'=>$products, 'index_route'=>route('product.index')])
</div>
