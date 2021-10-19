@extends('layouts.app')

@section('content')
	<div class="d-flex justify-content-end">
		<a href="{{ route('categories.create') }}" class="btn btn-success float-right mb-2">Add Category</a>
	</div>
	<div class="card card-default">
		<div class="card-header">Categories</div>
		<div class="card-body">
			@if( $categories->count() > 0)
				<table class="table">
					<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
						<th>Posts Count</th>
						<th>Category Actions</th>
					</tr>
					</thead>
					<tbody>
					@foreach($categories as $category)
						<tr>
							<td>{{ $category->id }}</td>
							<td>{{ $category->name }}</td>
							<td>{{ $category->posts->count() }}</td>
							<td style="display: flex; justify-content: space-between">
								<a href="{{ route('categories.edit', $category->id) }}" class="btn btn-info btn-sm" style="width: 50%">Edit</a>
								<button type="button" class="btn btn-danger btn-sm" onclick="handleDelete({{ $category->id }})" style="width: 50%">
									Delete
								</button>
							</td>
						</tr>
					@endforeach
					</tbody>
				</table>
			@else
				<h3 class="text-center text-info">No Categories Yet</h3>
			@endif


			<!-- Modal -->
			<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<form action="" method="POST" id="deleteCategoryForm">
						@method("DELETE")
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="deleteModalLabel">Delete Category</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<p>Are you sure you want to delete this Category;</p>
							</div>
							<div class="modal-footer">
								@csrf
								<button type="button" class="btn btn-success" data-bs-dismiss="modal">No, Go Back</button>
								<button type="submit" class="btn btn-warning">Yes, Delete</button>
							</div>
						</div>
					</form>
				</div>
			</div>


		</div>
	</div>
@endsection

@section('scripts')
	<script type="application/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script type="application/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.1/js/bootstrap.min.js"></script>
	<script>
		function handleDelete(id) {
			// console.log("Deleting category #" + id);
			const form = document.getElementById('deleteCategoryForm');
			form.action = '/cms/public/categories/' + id;
			console.log("Deleting category " + form);
			$("#deleteModal").modal('show');
		}
	</script>
@endsection

@section('styling')
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.1/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css" />
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}" />
@endsection