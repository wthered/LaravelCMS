<?php

	namespace App\Http\Controllers;

	use App\Http\Requests\Users\UpdateProfileRequest;
	use App\Models\User;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Auth;

	class UsersCtrl extends Controller {
		public function index() {
			return view('users.index')->with('users', User::all());
		}

		public function makeAdmin(User $user) {
			$user->role = 'admin';
			$user->save();
			session()->flash('success', 'User ' . $user->name . ' has been successfully made admin');
			return redirect(route('users.index'));
		}

		public function profile() {
			return view('users.profile')->with('user', Auth::user());
		}

		public function update(UpdateProfileRequest $req) {
			$user = Auth::user();
			$user->update([
				'name' => $req->username,
				'about' => $req->about,
				'first_name' => $req->name,
				'last_name' => $req->surname,
			]);
			session()->flash('success', 'User ' . $user->id . ' has been successfully updated');
			return redirect()->back();
		}

		// Used By API
		public function getUsers() {
			return User::all();
		}

		// Used By API
		public function getUserInfo(Request $r) {
			return User::find($r->id);
		}
	}
