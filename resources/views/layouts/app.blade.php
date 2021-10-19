<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'Laravel') }}</title>

	<!-- Fonts -->
	<link rel="dns-prefetch" href="//fonts.gstatic.com">
	<link rehref="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

	@yield('styling')

</head>
<body>
<div id="app">
	<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #7ed6df">
		<div class="container-fluid">
			<a class="navbar-brand" href="/cms/public">{{ config('app.name', 'Laravel') }}</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					@guest
						@if (Route::has('login'))
							<li class="nav-item">
								<a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
							</li>
						@endif

						@if (Route::has('register'))
							<li class="nav-item">
								<a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
							</li>
						@endif
					@else
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
								{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
							</a>
							<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
								<li><a class="dropdown-item" href="{{ route('users.profile') }}">Profile</a></li>
								<li>
									<hr class="dropdown-divider">
								</li>
								<li><a class="dropdown-item"
								       href="{{ route('logout') }}"
								       onclick="event.preventDefault();
								   document.getElementById('logout-form').submit();">
										{{ __('Logout') }}
									</a></li>
							</ul>

							<form action="{{ route('logout') }}" id="logout-form" method="POST" style="display: none">
								@csrf
							</form>
						</li>
					@endguest
				</ul>
				<a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
			</div>
		</div>
	</nav>

	<main class="py-4">
		@auth
			<div class="container">
				@if(session()->has('success'))
					<div class="alert alert-success">{{ session()->get('success') }}</div>
				@endif

				@if(session()->has('error'))
					<div class="alert alert-danger">{{ session()->get('error') }}</div>
				@endif

				<div class="row">
					<div class="col-md-3">
						<ul class="list-group">
							@if( Auth::user()->isAdmin())
								<li class="list-group-item"><a href="{{ route('users.index') }}">Users</a></li>
							@endif
							<li class="list-group-item"><a href="{{ route('posts.index') }}">Posts</a></li>
							<li class="list-group-item"><a href="{{ route('categories.index') }}">Categories</a></li>
							<li class="list-group-item"><a href="{{ route('tags.index') }}">Tags</a></li>
						</ul>
						<ul class="list-group mt-3">
							<li class="list-group-item"><a href="{{ route('trashed-posts.index') }}">Trash Can</a></li>
						</ul>
					</div>
					<div class="col-md-9">
						@yield('content')
					</div>
				</div>
			</div>
		@else
			<div class="container">
				@yield('content')
			</div>
			<example-component></example-component>
		@endauth
	</main>
</div>

@yield('scripts')
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
