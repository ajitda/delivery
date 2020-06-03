<div id="orderTable">
    <table class="table table-sm table-hover table-striped table-success">
        <thead>
            <tr>
                <th>Delivery Name - Phone</th>
                <th>Delivery Address</th>
                <th>Marchant</th>
                <th>Status</th>
                <th>Order Note</th>
                <th>Deliverd By</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $value)
            <tr>
                <td>{{$value->pickup_contact_id}}</td>
                <td>{{$value->delivery_contact_id}}</td>
                <td>{{$value->product_id}}</td>
                <td><span class="badge badge-success fs-16">{{$value->status}}</span></td>
                <td>{{$value->user_id}}</td>
                <td>{{$value->address}}</td>
                <td>
                @php
                    $actions = [
                      //['data-replace'=>'#showCustomer','url'=>'#showCustomerModal','ajax-url'=>url('customers/' . $value->id . '/'), 'name'=>'View Profile', 'icon'=>'eye'],
                      ['data-replace'=>'#editOrder', 'url'=>'#editOrderModal','ajax-url'=>url('order/'.$value->id.'/edit'), 'name'=>__('Edit'), 'icon'=>'pencil-alt'],
                      //['url'=>'merchant/' . $value->id,'name'=>'delete']
                      ];
                @endphp
                @include('includes.actions', ['actions'=>$actions])
                </td>
            </tr>
             @endforeach
        </tbody>
    </table>
    @include('includes.pagination', ['items'=>$orders, 'index_route'=>route('order.index')])
</div>
