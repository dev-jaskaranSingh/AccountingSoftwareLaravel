<!DOCTYPE html>
<html>


<!-- Mirrored from webapplayers.com/inspinia_admin-v2.9.2/dashboard_2.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 02 Jul 2019 07:38:37 GMT -->
@include('components.head')

<body>
<div id="wrapper">
    @include('components.sidemenu')

    <div id="page-wrapper" class="gray-bg">
        @include('components.navbar')
            @yield('content')
        @include('components.footer')
    </div>
</div>

@include('components.script')
<script >
	$(document).on('click','.select2',function(){
		
		
		$('.select2-search__field').select();
		
	});
	// class="select2-search__field"
</script>

</body>

<!-- Mirrored from webapplayers.com/inspinia_admin-v2.9.2/dashboard_2.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 02 Jul 2019 07:38:46 GMT -->
</html>
