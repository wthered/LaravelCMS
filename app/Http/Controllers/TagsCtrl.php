<?php
	
	namespace App\Http\Controllers;
	
	use App\Models\Tag;
	use Illuminate\Contracts\Foundation\Application;
	use Illuminate\Contracts\View\Factory;
	use Illuminate\Contracts\View\View;
	use Illuminate\Http\RedirectResponse;
	use App\Http\Requests\Tags\createTagRequest;
	use App\Http\Requests\Tags\updateTagRequest;
	use Illuminate\Routing\Redirector;
	
	
	class TagsCtrl extends Controller
	{
		/**
		 * Display a listing of the resource.
		 *
		 * @return Application|Factory|View
		 */
		public function index() {
//    	dd(blogtag::first()->posts()->where('published_at', today())->get());
			return view('tags.index')->with('tags', Tag::all());
		}
		
		/**
		 * Show the form for creating a new resource.
		 *
		 * @return Application|Factory|View
		 */
		public function create() {
			return view('tags.create');
		}
		
		/**
		 * Store a newly created resource in storage.
		 *
		 * @param createTagRequest $req
		 * @return Application
		 */
		public function store(createTagRequest $req) {
			Tag::create([
				'name' => $req->input('name'),
			]);
			$req->session()->flash('success', 'Tag successfully created');
			return redirect(route('tags.index'));
		}
		
		/**
		 * Display the specified resource.
		 *
		 * @param tagsCtrl $tagsCtrl
		 * @return void
		 */
		public function show(tagsCtrl $tagsCtrl) {
			//
		}
		
		/**
		 * Show the form for editing the specified resource.
		 *
		 * @param Tag $tag
		 * @return Application|Factory|View
		 */
		public function edit(Tag $tag) {
			return view('tags.create')->with('tag', $tag);
		}
		
		/**
		 * Update the specified resource in storage.
		 *
		 * @param updatetagRequest $request
		 * @param Tag $tag
		 * @return Application|RedirectResponse|Redirector
		 */
		public function update(updatetagRequest $request, Tag $tag) {
			// https://www.youtube.com/watch?v=PD2Ygspsbec&list=PL78sHffDjI74qqNlqtqV_tx5E0_NG1IXQ&index=25
			$tag->update([
				'name' => $request->input('name'),
			]);
			$request->session()->flash('success', 'tag updated to ' . $tag->name);
			return redirect(route('tags.index'));
		}
		
		/**
		 * Remove the specified resource from storage.
		 *
		 * @param Tag $tag
		 * @return RedirectResponse
		 */
		public function destroy(Tag $tag) {
			if ($tag->posts->count() > 0) {
				session()->flash('error', 'Tag can not be deleted because it is associated with some posts');
				return redirect()->back();
			}
			$tag->delete();
			session()->flash('success', 'tag deleted');
			return redirect(route('tags.index'));
		}
	}