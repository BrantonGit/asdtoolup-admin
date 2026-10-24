<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use TradeInTradeUp\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\TradeInTradeUp\User>
 */
class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\TradeInTradeUp\User>
     */
    protected $model = User::class;

    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fname' => fake()->firstName(),
            'lname' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'password' => static::$password ??= Hash::make('password'),
            'role' => 0,
            'phone' => fake()->phoneNumber(),
            'company' => fake()->company(),
            'profession' => fake()->jobTitle(),
            'address' => fake()->streetAddress(),
            'city' => fake()->city(),
            'postal' => fake()->postcode(),
            'notifications' => 1,
            'remember_token' => Str::random(10),
        ];
    }
}
