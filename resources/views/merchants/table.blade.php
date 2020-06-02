<div id="merchantTable">
    <table class="table table-hover table-striped table-success">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Date of Birth</th>
                <th>Document No</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($merchants as $value)
            <tr>
                <td>{{$value->first_name}}</td>
                <td>{{$value->last_name}}</td>
                <td>{{$value->date_of_birth}}</td>
                <td>{{$value->document_no}}</td>
                <td>{{$value->phone}}</td>
                <td>{{$value->address}}</td>
                <td>
                @php
                    $actions = [
                      //['data-replace'=>'#showCustomer','url'=>'#showCustomerModal','ajax-url'=>url('customers/' . $value->id . '/'), 'name'=>'View Profile', 'icon'=>'eye'],
                      ['data-replace'=>'#editMerchant', 'url'=>'#editMerchantModal','ajax-url'=>url('merchant/'.$value->id.'/edit'), 'name'=>__('Edit'), 'icon'=>'pencil-alt'],
                      //['url'=>'merchant/' . $value->id,'name'=>'delete']
                      ];
                @endphp
                @include('includes.actions', ['actions'=>$actions])
                </td>
            </tr>
             @endforeach
        </tbody>
    </table>
    @include('includes.pagination', ['items'=>$merchants, 'index_route'=>route('merchant.index')])
</div>
