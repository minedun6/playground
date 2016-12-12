<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\Customer::class, function(Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'phone' => $faker->phoneNumber
    ];
});

$factory->define(App\Models\Project::class, function(Faker\Generator $faker) {
    return [
        'name' => $faker->sentence(3),
        'start_date' => $faker->date(),
        'due_date' => $faker->date(),
        'progress' => $faker->numberBetween(0, 100),
        'description' => $faker->paragraph,
        'customer_id' => App\Models\Customer::all()->random()->id
    ];
});

$factory->define(App\Models\Task::class, function(Faker\Generator $faker) {
    return [
        'title' => $faker->sentence(3, true),
        'description' => $faker->sentence(10, true),
        'user_id' => App\Models\User::all()->random()->id,
        'group_id' => $faker->randomElement(['1', '2', '3']),
        'project_id' => App\Models\Project::all()->random()->id,
        'order' => $faker->randomDigitNotNull
    ];
});