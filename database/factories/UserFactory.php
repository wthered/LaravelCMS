<?php
	
	namespace Database\Factories;
	
	use App\Models\User;
	use Illuminate\Database\Eloquent\Factories\Factory;
	use Illuminate\Support\Str;
	
	class UserFactory extends Factory {
		/**
		 * The name of the factory's corresponding model.
		 *
		 * @var string
		 */
		protected $model = User::class;
		
		/**
		 * Define the model's default state.
		 *
		 * @return array
		 */
		public function definition() {
			$name = $this->faker->firstName;
			$last = $this->faker->lastName;
			$user = preg_replace("/[^a-zA-Z0-9]/", chr(rand(65, 122)), $this->faker->userName) . Str::random(4);
			$host = $this->faker->domainName;
			$mail = $user . '@' . $host;
			return [
				'first_name' => $name,
				'last_name' => $last,
				'name' => $user,
				'email' => $mail,
				'verified_at' => $this->faker->dateTimeThisDecade('now', 'Europe/Athens'),
				'password' => '$2y$12$' . Str::random(53),
				'registered_from' => $this->faker->ipv4,
				'remember_token' => Str::random(),
				'registered_at' => $this->faker->dateTimeThisDecade,
				'about' => $this->faker->sentence,
			];
		}
		
		/**
		 * Indicate that the model's email address should be unverified.
		 *
		 * @return \Illuminate\Database\Eloquent\Factories\Factory
		 */
		public function unverified() {
			return $this->state(function (array $attributes) {
				return [
					'email_verified_at' => null,
				];
			});
		}
	}
