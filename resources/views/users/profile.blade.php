@extends('layouts.app')

@section('content')
	<div class="card">
		<div class="card-header">My Profile</div>
		<div class="card-body">
			@include('partials.error')
			<form action="{{ route('users.update') }}" method="POST">
				@csrf
				@method('PUT')
				<div class="form-group">
					<label for="name">First Name</label>
					<input type="text" id="name" class="form-control" name="name" value="{{ $user->first_name }}" />
				</div>

				<div class="form-group">
					<label for="surname">Last Name</label>
					<input type="text" id="surname" class="form-control" name="surname" value="{{ $user->last_name }}" />
				</div>

				<div class="form-group">
					<label for="username">Username</label>
					<input type="text" id="username" class="form-control" name="username" value="{{ $user->name }}" />
				</div>
				<div class="form-group">
					<label for="about">About</label>
					<textarea name="about" id="about" class="form-control" rows="10" style="resize: vertical">{{ $user->about }}</textarea>
				</div>
				<button type="submit" class="btn btn-success">Update Profile</button>
			</form>
		</div>
		<div class="card-footer">Member Since {{ $user->created_at }}</div>
	</div>
@endsection

@section('styling')
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.1/css/bootstrap.min.css" />
@endsection

@section('scripts')
	<script type="application/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.1/js/bootstrap.min.js"></script>
@endsection