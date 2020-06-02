{{-- <script src="{{asset('js/bootstrap-notify/bootstrap-notify.js')}}" type="text/javascript"></script> --}}
<script>
window.jQuery.notifyDefaults({
	placement: {
		from: "top",
		align: "center"
	},
	delay: 500
});

@php while(($notify = session()->pull('notify',false))) {  @endphp
	window.jQuery.notify({!! json_encode($notify[0]['options']) !!},{!! json_encode($notify[0]['settings']) !!});
@php } @endphp

</script>
