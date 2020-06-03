<div id="contactTable">
    <table class="table table-hover table-striped table-success">
        <thead>
            <tr>
                <th>Name</th>
                <th>Address</th>
                <th>Type</th>
                <th>Phone</th>
                <th>Alt Phone</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contacts as $value)
            <tr>
                <td>{{$value->name}}</td>
                <td>{{$value->address}}</td>
                <td>{{$value->type}}</td>
                <td>{{$value->phone}}</td>
                <td>{{$value->alt_phone}}</td>
                <td>
                @php
                    $actions = [
                      //['data-replace'=>'#showCustomer','url'=>'#showCustomerModal','ajax-url'=>url('customers/' . $value->id . '/'), 'name'=>'View Profile', 'icon'=>'eye'],
                      ['data-replace'=>'#editContact', 'url'=>'#editContactModal','ajax-url'=>url('contact/'.$value->id.'/edit'), 'name'=>__('Edit'), 'icon'=>'pencil-alt'],
                      //['url'=>'merchant/' . $value->id,'name'=>'delete']
                      ];
                @endphp
                @include('includes.actions', ['actions'=>$actions])
                </td>
            </tr>
             @endforeach
        </tbody>
    </table>
    @include('includes.pagination', ['items'=>$contacts, 'index_route'=>route('contact.index')])
</div>
