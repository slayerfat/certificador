<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(TitleTableSeeder::class);

        if (app()->environment() == 'local') {
            $this->call(EventTableSeeder::class);
        }
    }
}
