<div class="btn-group">
    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
      <i class="fas fa-list"></i><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
    <div class="dropdown-menu" role="menu">
        @foreach($actions as $action)
            @if($action['name'] == 'delete')
                <a class="dropdown-item delete-form" href="#" onclick="return confirm('are you sure?')"><i class="fas fa-trash-alt"></i>{{ Form::open(array('url' => $action['url'], 'class' => 'form-inline')) }}
                {{ Form::hidden('_method', 'DELETE') }}
                {{ Form::submit(__('Delete'), array('class' => 'delete-btn')) }}
                {{ Form::close() }}</a>
            @else
                <a class="dropdown-item action-link" href="{{$action['url']}}"
                    @if(!empty($action['data-replace'])) data-replace-empty="{{$action['data-replace']}}" @endif
                    @if(!empty($action['ajax-url'])) data-ajax-url="{{$action['ajax-url']}}" data-toggle="modal" @endif
                 ><i class="fas fa-{{!empty($action['icon']) ? $action['icon'] : 'eye'}}"></i>{{$action['name']}}</a>
            @endif
        @endforeach
    </div>
  </div>
