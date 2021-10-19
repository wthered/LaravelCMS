@extends('layouts.app')

@section('content')
	<div class="card card-default">
		<div class="card-header">{{ isset($post) ? 'Update Post' : 'Create Post' }}</div>
		<div class="card-body">
			@include('partials.error')
			<form action="{{ isset($post) ? route('posts.update', $post->id) : route('posts.store') }}" method="POST" enctype="multipart/form-data">
				@if( isset($post) )
					@method('PUT')
				@endif
				<div class="form-group">
					<label for="title">Title</label>
					<input type="text" class="form-control" id="title" name="title" value="{{ isset($post) ? $post->title : '' }}"/>
				</div>

				<div class="form-group">
					<label for="description">Description</label>
					<textarea class="form-control" id="description" name="description" placeholder="Post Description">{{ isset($post) ? $post->description : '' }}</textarea>
				</div>

				<div class="form-group">
					<label for="content">Content</label>
					<input id="content" type="hidden" name="post_content" value="{{ isset($post) ? $post->content : '' }}">
					<trix-editor input="content"></trix-editor>
				</div>

				<div class="form-group">
					<label for="published_at">Published Date</label>
					<input type="text" class="form-control" id="published_at" name="published_at" value="{{ isset($post) ? $post->published_at : '' }}"/>
				</div>

				@if( isset($post))
					<div class="form-group">
						<img src="http://www.pliassas.gr/cms/storage/app/public/{{ $post->image }}" alt="{{ $post->title }} Image" style="max-width: 100%"/>
					</div>
				@endif
				<div class="form-group">
					<label for="image">Image</label>
					<input type="file" class="form-control" id="image" name="image"/>
				</div>

				<div class="form-group">
					<label for="category">Category</label>
					<select name="category" id="category" class="form-control">
						<option value="">Select Category</option>
						@foreach($categories as $category)
							<option value="{{ $category->id }}"
							        @if( isset($post) )
							        @if($category->id === $post->blog_category_id)
							        selected
									@endif
									@endif
							>{{ $category->name }}</option>
						@endforeach
					</select>
				</div>

				@if( $tags->count() > 0 )
					<div class="form-group">
						<label for="tags">Tags</label>
						<select name="tags[]" id="tags" class="form-control tags-selector" multiple>
							@foreach($tags as $tag)
								<option value="{{ $tag->id }}"
								        @if( isset($post) && $post->hasTag($tag->id)) selected @endif
								>{{ $tag->name }}</option>
							@endforeach
						</select>
					</div>
				@endif

				<div class="form-group">
					@csrf
					<button type="submit" class="btn btn-info">{{ isset($post) ? 'Update Post' : 'Create Post' }}</button>
				</div>
			</form>
		</div>
	</div>
@endsection

@section('scripts')
	<script type="application/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script type="application/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.1/js/bootstrap.min.js"></script>
	<script type="application/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js"></script>
	<script type="application/javascript" src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
	<script type="application/javascript" src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<script>
		flatpickr('#published_at', {
			enableTime: false,
			altInput: true,
			altFormat: "l, j F Y",
			dateFormat: "Y-m-d",
		});

		$(document).ready(function() {
			$('.tags-selector').select2();
		});
	</script>
@endsection

@section('styling')
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.1/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css"/>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}"/>
@endsection