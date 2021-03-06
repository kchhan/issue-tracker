<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
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
    public function definition()
    {
        static $password;

        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'username' => $this->faker->unique()->username,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => $password ?: $password = bcrypt(env('USER_FACTORY_PASSWORD')),
            'remember_token' => Str::random(10),
        ];
    }
}
