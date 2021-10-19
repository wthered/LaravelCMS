<?php

namespace App\Http\Middleware;

use App\Models\blogCategory;
use Closure;
use Illuminate\Http\Request;

class VerifyCategoriesCount
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next) {
    	if( blogCategory::all()->count() === 0) {
    		$request->session()->flash('error', 'There are no Categories created');
    		return redirect(route('categories.create'));
	    }
        return $next($request);
    }
}
