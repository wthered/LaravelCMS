<?php

	namespace Database\Seeders;

	use App\Models\User;
	use Faker\Core\Number;
	use Faker\Provider\DateTime;
	use Faker\Provider\Internet;
	use Faker\Provider\Lorem;
	use Illuminate\Database\Seeder;
	use Illuminate\Support\Facades\Hash;

	class UsersTableSeeder extends Seeder {
		/**
		 * Run the database seeds.
		 *
		 * @return void
		 */
		public function run() {
			$user = User::where('email', 'wthered@gmail.com')->first();
			$ntina= User::where('email', 'ntina23gr@freemail.gr')->first();

			if (!$user) {
				User::create([
					'first_name' => 'Βασίλης',
					'last_name' => 'Πλιάσσας',
					'about' => Lorem::sentence(),
					'name' => 'wthered',
					'email' => 'wthered@gmail.com',
					'role' => 'admin',
					'password' => Hash::make('!p9lastiras', ['rounds' => 12]),
					'registered_from' => '155.207.123.69',
					'registered_at' => '1980-09-15 03:14:15',
					'verified_at' => DateTime::dateTimeThisDecade('now', 'Europe/Athens'),
					'remember_token' => 'd9SESO3iu2OGqgy6',
				]);
			}

			if (!$ntina) {
				User::create([
					'first_name' => 'Ντίνα',
					'last_name' => 'Παπαδοπούλου',
					'about' => Lorem::sentence(),
					'name' => 'ntina23gr',
					'email' => 'ntina23gr@freemail.gr',
					'role' => 'writer',
					'password' => Hash::make('!sm3llyc4t', ['rounds' => 12]),
					'registered_from' => Internet::localIpv4(),
					'registered_at' => DateTime::dateTimeThisDecade(),
					'verified_at' => DateTime::dateTimeThisDecade('now', 'Europe/Athens'),
					'remember_token' => 'xZpADHYePbyJmWyn',
				]);
			}
		}
	}
