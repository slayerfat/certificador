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

/**
 * Nos interesa que la cedula de indentidad no se repita para
 * no generar algun conflico al generar datos.
 *
 * @return int
 */
function makeCI()
{
    $number = rand(999999, 99999999);
    $user   = App\PersonalDetail::whereCi($number)->get();

    if ($user->isEmpty()) {
        return $number;
    }

    return makeCI();
}

$factory->define(App\PersonalDetail::class, function (Faker\Generator $faker) {
    return [
        'user_id'       => factory(App\User::class)->create()->id,
        'title_id'      => factory(App\Title::class)->create()->id,
        'sex'           => $faker->randomElement(['m', 'f']),
        'first_name'    => $faker->firstName,
        'last_name'     => $faker->firstName,
        'first_surname' => $faker->lastName,
        'last_surname'  => $faker->lastName,
        'ci'            => makeCI(),
        'phone'         => '0' . rand(400, 499)
            . rand(100, 999) . rand(1000, 9999),
        'cellphone'     => '0' . rand(400, 499)
            . rand(100, 999) . rand(1000, 9999),
        'birthday'      => $faker->date('Y-m-d', '-18 years'),
    ];
});

$factory->define(App\Event::class, function (Faker\Generator $faker) {
    return [
        'institute_id' => factory(App\Institute::class)->create()->id,
        'name'         => $faker->sentence,
        'hours'        => rand(1, 32),
        'content'      => $faker->paragraph(),
        'location'     => $faker->sentence,
        'info'         => $faker->sentence,
        'date'         => date('Y-m-d', strtotime('1 month')),
    ];
});

$factory->define(App\Institute::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
    ];
});

$factory->define(App\Professor::class, function () {
    return [
        'personal_detail_id' => factory(App\PersonalDetail::class)->create()->id,
        'title_id'           => factory(App\Title::class)->create()->id,
    ];
});

$factory->define(App\Title::class, function (Faker\Generator $faker) {
    return [
        'desc' => $faker->title,
    ];
});

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name'           => $faker->name,
        'email'          => $faker->email,
        'admin'          => false,
        'password'       => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});
