@extends('layouts.app')

@section('content')
	<div class="card card-default">
		<div class="card-header">Users</div>
		@if( $users->count() > 0)
			<div class="card-body">
				<table class="table">
					<thead>
					<tr>
						<th>Image</th>
						<th>Name</th>
						<th>Email</th>
						<th>Actions</th>
						<th></th>
					</tr>
					</thead>
					<tbody>
					@foreach($users as $user)
						<tr>
							<td>
								<img src="https://robohash.org/{{ $user->remember_token }}.png?set=set5" alt="User Avatar" class="img-fluid" />
							</td>
							<td>{{ $user->name }}</td>
							<td>
								{{ $user->email }}
							</td>

							<td>
								@if( !$user->isAdmin())
									<form action="{{ route('users.make-admin', $user->id) }}" METHOD="POST">
										@csrf
										<button type="submit" class="btn btn-warning btn-sm">Make Admin</button>
									</form>
								@endif
							</td>
						</tr>
					@endforeach
					</tbody>
				</table>
			</div>
		@else
			<h3 class="text-center text-info">No Users Yet</h3>
		@endif
	</div>
@endsection

@section('scripts')
	<script type="application/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="{{ asset('js/app.js') }}" defer></script>
	<script type="application/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.1/js/bootstrap.min.js"></script>
	<script type="application/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js"></script>
@endsection

@section('styling')
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.1/css/bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css"/>
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endsection