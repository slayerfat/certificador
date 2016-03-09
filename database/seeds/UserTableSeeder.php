<?php

use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $user = new User;
        $user->name = env('USER_NAME');
        $user->email = env('USER_EMAIL');
        $user->password = bcrypt(env('USER_PW'));
        $user->admin = true;

        $user->save();
    }
}
