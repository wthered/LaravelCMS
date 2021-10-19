<?php
	
	namespace App\Http\Middleware;
	
	use Closure;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Auth;
	
	class VerifyIsAdmin {
		/**
		 * Handle an incoming request.
		 *
		 * @param Request $request
		 * @param Closure $next
		 * @return mixed
		 */
		public function handle(Request $request, Closure $next) {
			if( !Auth::user()->isAdmin()) {
				return redirect(route('home'));
			}
			return $next($request);
		}
	}
