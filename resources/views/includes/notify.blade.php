{{-- <script src="{{asset('js/bootstrap-notify/bootstrap-notify.js')}}" type="text/javascript"></script> --}}
<script>


@php while(($notify = session()->pull('notify',false))) {  @endphp
	window.jQuery.notify({!! json_encode($notify[0]['options']) !!},{!! json_encode($notify[0]['settings']) !!});
@php } @endphp

</script>
