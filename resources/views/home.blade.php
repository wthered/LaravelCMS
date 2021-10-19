@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">{{ __('Dashboard') }}</div>

					<div class="card-body">
						@if (session('status'))
							<div class="alert alert-success" role="alert">
								{{ session('status') }}
							</div>
						@endif

						<div class="card" style="width: 50%">
							<div class="card-header">{{ Auth::user()->name }}</div>
							<div class="card-body">
								{{ __('You are logged in!') }}
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">Line 26 of Home</div>
		</div>
	</div>
@endsection

@section('styling')
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.1/css/bootstrap.min.css" />
@endsection

@section('scripts')
	<script type="application/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.1/js/bootstrap.min.js"></script>
@endsection