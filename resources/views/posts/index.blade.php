@extends('layouts.app')

@section('content')
	<div class="d-flex justify-content-end">
		<a href="{{ route('posts.create') }}" class="btn btn-success float-right mb-2">Add Post</a>
	</div>

	<div class="card card-default">
		<div class="card-header">Posts</div>
		@if( $posts->count() > 0)
			<div class="card-body">
				<table class="table">
					<thead>
					<tr>
						<th>Image</th>
						<th>Title</th>
						<th>Category</th>
						<th>Actions</th>
						<th></th>
					</tr>
					</thead>
					<tbody>
					@foreach($posts as $post)
						<tr>
							<td>
								<img src="http://www.pliassas.gr/cms/storage/app/public/{{ $post->image }}" alt="" style="max-width: 256px; height: auto;" />
							</td>
							<td>{{ $post->title }}</td>
							<td>
								<a href="{{ route('categories.edit', \App\Models\blogCategory::find($post->blog_category_id)->id) }}">{{ \App\Models\blogCategory::find($post->blog_category_id)->name }}</a>
							</td>
							@if( $post->trashed())
								<td>
									<form action="{{ route('restore-posts', $post->id) }}" method="POST">
										@method('PUT')
										@csrf
										<button type="submit" class="btn btn-info btn-sm">Restore</button>
									</form>
								</td>
							@else
								<td>
									<a href="{{ route('posts.edit', $post->id) }}" class="btn btn-success btn-sm" style="width: 100%">Edit</a>
								</td>
							@endif
							<td>
								<form action="{{ route('posts.destroy', $post->id) }}" method="POST">
									@method('DELETE')
									@csrf
									<button type="submit" class="btn btn-danger btn-sm" style="width: 100%">
										{{ $post->trashed() ? 'Delete' : 'Trash' }}
									</button>
								</form>
							</td>
						</tr>
					@endforeach
					</tbody>
				</table>
			</div>
		@else
			<h3 class="text-center text-info">No Posts Yet</h3>
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
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.1/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css" />
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endsection