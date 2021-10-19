@extends('layouts.app')

@section('content')
	<div class="card card-default">
		<div class="card-header">
			{{ isset($category) ? 'Edit Category' : 'Create Category' }}
		</div>
		<div class="card-body">
			@include('partials.error')
			<div class="form-group">
				<form action="{{ isset($category) ? route('categories.update', $category->id) : route('categories.store') }}" method="POST">
					@csrf
					@if( isset($category) )
						@method('PUT')
					@endif
					<label for="name">Name</label>
					<input type="text" class="form-control" id="name" name="name" value="{{ isset($category) ? $category->name : '' }}" />
				</form>
			</div>
			<div class="form-group">
				<button class="btn btn-success mt-2">
					{{ isset($category) ? 'Update Category' : 'Add Category' }}
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
