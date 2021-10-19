@extends('layouts.app')

@section('content')
	<div class="card" style="width: 100%">
		<div class="card-header">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</div>
		<div class="card-body">
			{{ __('You are logged in!') }}
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