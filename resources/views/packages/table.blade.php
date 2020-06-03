<div id="packageTable">
    <table class="table table-hover table-striped table-success">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($packages as $value)
            <tr>
                <td>{{$value->name}}</td>
                <td>{{$value->description}}</td>
                <td>{{$value->price}}</td>
                <td>
                @php
                    $actions = [
                      //['data-replace'=>'#showCustomer','url'=>'#showCustomerModal','ajax-url'=>url('customers/' . $value->id . '/'), 'name'=>'View Profile', 'icon'=>'eye'],
                      ['data-replace'=>'#editPackage', 'url'=>'#editPackageModal','ajax-url'=>url('package/'.$value->id.'/edit'), 'name'=>__('Edit'), 'icon'=>'pencil-alt'],
                      //['url'=>'merchant/' . $value->id,'name'=>'delete']
                      ];
                @endphp
                @include('includes.actions', ['actions'=>$actions])
                </td>
            </tr>
             @endforeach
        </tbody>
    </table>
    @include('includes.pagination', ['items'=>$packages, 'index_route'=>route('package.index')])
</div>
