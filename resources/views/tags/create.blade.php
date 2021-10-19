@extends('layouts.app')

@section('content')
	<div class="card card-default">
		<div class="card-header">
			{{ isset($tag) ? 'Edit Tag' : 'Create Tag' }}
		</div>
		<div class="card-body">
			@include('partials.error')
			<div class="form-group">
				<form action="{{ isset($tag) ? route('tags.update', $tag->id) : route('tags.store') }}" method="POST">
					@csrf
					@if( isset($tag) )
						@method('PUT')
					@endif
					<label for="name">Name</label>
					<input type="text" class="form-control" id="name" name="name" value="{{ isset($tag) ? $tag->name : '' }}" />
				</form>
			</div>
			<div class="form-group">
				<button class="btn btn-success mt-2">
					{{ isset($tag) ? 'Update Tag' : 'Add Tag' }}
				</button>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
	<script type="application/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script type="application/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.1/js/bootstrap.min.js"></script>
@endsection

@section('styling')
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.1/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}" />
@endsection
