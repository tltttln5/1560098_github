<!DOCTYPE html>
<html>
<head>
	<title>Khoa Pham</title>
	<meta charset="utf-8">
	<meta http-equiv ="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
</head>
<body>
	@include('layouts.header')
	<div id="content">
		<h1>Khoa Pham</h1>
		@yield('NoiDung')	
		
	</div>
	@include('layouts.footer')


</body>
</html>