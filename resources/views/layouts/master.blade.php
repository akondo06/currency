<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>Curs Valutar</title>
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
		<link href="{{ trim(elixir('css/app.css'), '/') }}" rel="stylesheet" type="text/css" />
		@yield('head')
	</head>
	<body>
		<div class="wrapper-main">
			@include('components.header')
			<div class="content-main">
				@yield('body')
			</div>
			@include('components.footer')
		</div>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	
		<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
		<script src="https://www.amcharts.com/lib/3/serial.js"></script>
		<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
		<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>

		@yield('scripts')
		<script type="text/javascript" src="{{ trim(elixir('js/app.js'), '/') }}"></script>
	</body>
</html>

@section('head')
@endsection

@section('body')
@endsection

@section('scripts')
@endsection
