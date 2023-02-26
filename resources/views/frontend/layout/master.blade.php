
<!DOCTYPE html>
<html class="" lang="zxx">

<!-- Mirrored from utouchdesign.com/themes/envato/escort/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 22 Feb 2023 12:17:13 GMT -->
<head>
	<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="author" content="">
<meta name="description" content="">
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>:: Escort - Job Portal HTML Template ::</title>
@include('frontend.layout.include.header_link')

<!-- Favicon Icon -->
</head>
<body class="utf_skin_area">
<div class="page_preloader"></div>
@include('frontend.layout.include.header')

<!-- ======================= Start Banner ===================== -->
@yield('section')
@yield('custom_js')
<!-- End Signup --> 
<div><a href="#" class="scrollup">Scroll</a></div>
@include('frontend.layout.include.footer')

@include('frontend.layout.include.footer_link')

<!-- Jquery js--> 
</body>

<!-- Mirrored from utouchdesign.com/themes/envato/escort/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 22 Feb 2023 12:18:09 GMT -->
</html>