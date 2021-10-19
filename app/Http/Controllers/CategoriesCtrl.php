<?php
	
	namespace App\Http\Controllers;
	
	use App\Models\blogCategory;
	use Illuminate\Contracts\Foundation\Application;
	use Illuminate\Contracts\View\Factory;
	use Illuminate\Contracts\View\View;
	use Illuminate\Http\RedirectResponse;
	use Illuminate\Http\Response;
	use App\Http\Requests\Categories\createCategoryRequest;
	use App\Http\Requests\Categories\updateCategoryRequest;
	use Illuminate\Routing\Redirector;
	
	
	class CategoriesCtrl extends Controller
	{
		/**
		 * Display a listing of the resource.
		 *
		 * @return Application|Factory|View
		 */
		public function index() {
//    	dd(blogCategory::first()->posts()->where('published_at', today())->get());
			return view('categories.index')->with('categories', blogCategory::all());
		}
		
		/**
		 * Show the form for creating a new resource.
		 *
		 * @return Application|Factory|View
		 */
		public function create() {
			return view('categories.create');
		}
		
		/**
		 * Store a newly created resource in storage.
		 *
		 * @param createCategoryRequest $req
		 * @return Application
		 */
		public function store(createCategoryRequest $req) {
			blogCategory::create([
				'name' => $req->input('name'),
			]);
			$req->session()->flash('success', 'Category successfully created');
			return redirect(route('categories.index'));
		}
		
		/**
		 * Display the specified resource.
		 *
		 * @param CategoriesCtrl $categoriesCtrl
		 * @return void
		 */
		public function show(categoriesCtrl $categoriesCtrl) {
			//
		}
		
		/**
		 * Show the form for editing the specified resource.
		 *
		 * @param blogCategory $category
		 * @return Application|Factory|View
		 */
		public function edit(blogCategory $category) {
			return view('categories.create')->with('category', $category);
		}
		
		/**
		 * Update the specified resource in storage.
		 *
		 * @param updateCategoryRequest $request
		 * @param blogCategory $category
		 * @return Application|RedirectResponse|Redirector
		 */
		public function update(updateCategoryRequest $request, blogCategory $category) {
			// https://www.youtube.com/watch?v=PD2Ygspsbec&list=PL78sHffDjI74qqNlqtqV_tx5E0_NG1IXQ&index=25
			$category->update([
				'name' => $request->input('name'),
			]);
			$request->session()->flash('success', 'Category updated to ' . $category->name);
			return redirect(route('categories.index'));
		}
		
		/**
		 * Remove the specified resource from storage.
		 *
		 * @param blogCategory $category
		 * @return RedirectResponse
		 */
		public function destroy(blogCategory $category) {
			if ($category->posts->count() > 0) {
				session()->flash('error', 'Category can not be deleted because there are posts in this category');
				return redirect()->back();
			}
			$category->delete();
			session()->flash('success', 'Category deleted');
			return redirect(route('categories.index'));
		}
	}
