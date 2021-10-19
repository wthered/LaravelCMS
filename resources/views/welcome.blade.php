@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="d-flex" style="justify-content: center; align-items: center; height: 75vh">
				<h1>Welcome View</h1>
			</div>
			<div id="example"></div>
		</div>
	</div>
@endsection

@section('styling')
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.1/css/bootstrap.min.css" />
@endsection

@section('scripts')
	<script type="application/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script type="application/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.1/js/bootstrap.min.js"></script>
@endsection