<?php
	
	namespace App\Http\Controllers;
	
	use App\Http\Requests\Posts\createPostsRequest;
	use App\Http\Requests\Posts\updatePostsRequest;
	use App\Models\blogCategory;
	use App\Models\blogPost;
	use App\Models\Tag;
	use Illuminate\Contracts\Foundation\Application;
	use Illuminate\Contracts\View\Factory;
	use Illuminate\Contracts\View\View;
	use Illuminate\Http\RedirectResponse;
	use Illuminate\Http\Response;
	use Illuminate\Routing\Redirector;
	
	class PostsCtrl extends Controller
	{
		
		public function __construct() {
			$this->middleware('verifyCategoriesCount')->only(['create', 'store']);
		}
		
		/**
		 * Display a listing of the resource.
		 *
		 * @return Application|Factory|View
		 */
		public function index() {
			return view('posts.index')->with('posts', blogPost::all());
		}
		
		/**
		 * Show the form for creating a new resource.
		 *
		 * @return Application|Factory|View
		 */
		public function create() {
			return view('posts.create')->with('categories', blogCategory::all())->with('tags', Tag::all());
		}
		
		/**
		 * Store a newly created resource in storage.
		 *
		 * @param createPostsRequest $request
		 * @return Application|Redirector|RedirectResponse
		 */
		public function store(createPostsRequest $request) {
//    	dd($request->all());
			// Steps:
//	    1. Upload the image to storage
			$image = $request->image->store('posts');

//	    2. Create the Post
			$post = blogPost::create([
				'title' => $request->title,
				'description' => $request->description,
				'content' => $request->post_content,
				'image' => $image,
				'blog_category_id' => $request->category,
				'published_at' => $request->published_at
			]);
			
			if ($request->tags) {
				$post->tags()->attach($request->tags);
			}

//	    3. Flash Message
			$request->session()->flash('success', 'Post uploaded');

//      4. Redirect the user
			return redirect(route('posts.index'));
			//*************************************/
		}
		
		/**
		 * Display the specified resource.
		 *
		 * @param int $id
		 * @return void
		 */
		public function show($id) {
			//
		}
		
		/**
		 * Show the form for editing the specified resource.
		 *
		 * @param blogPost $post
		 * @return Application|Factory|View
		 */
		public function edit(blogPost $post) {
			return view('posts.create')
				->with('post', $post)
				->with('categories', blogCategory::all())
				->with('tags', Tag::all());
		}
		
		/**
		 * Update the specified resource in storage.
		 *
		 * @param updatePostsRequest $request
		 * @param blogPost $post
		 * @return Application|RedirectResponse|Redirector
		 */
		public function update(updatePostsRequest $request, blogPost $post) {
			$data = $request->only(['title', 'description', 'post_content', 'published_at', 'category']);

			$data['blog_category_id'] = $request->category;

			// 1. check if new image
			if ($request->hasFile('image')) {
				
				// 2. if new, upload
				$image = $request->image->store('posts');
				
				// 3. Delete Old one
				$post->deleteImage();
				$data['image'] = $image;
			}
			
			if ($request->tags) {
				$post->tags()->sync($request->tags);
			}
			
			// 4. Update attributes
			$post->update($data);
			
			// 5. flash Message
			$request->session()->flash('success', 'Post has been successfully updated');
			
			// 6. Redirect User
			return redirect(route('posts.index'));
		}
		
		/**
		 * Remove the specified resource from storage.
		 *
		 * @param blogPost $post
		 * @return Response
		 */
		public function destroy($id) {
			$post = blogPost::withTrashed()->where('id', $id)->firstOrFail();
			if ($post->trashed()) {
				$post->deleteImage();
				$post->forceDelete();
			} else {
				$post->delete();
			}
			session()->flash('success', 'Post deleted successfully');
			return redirect(route('posts.index'));
		}
		
		public function trashed() {
			$trashed = blogPost::onlyTrashed()->get();
			return view('posts.index')->with('posts', $trashed);
		}
		
		public function restore($id) {
			$post = blogPost::withTrashed()->where('id', $id)->firstOrFail();
			$post->restore();
			session()->flash('success', 'Post restored successfully');
			return redirect()->back();
		}
	}
