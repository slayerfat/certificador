<?php

use App\Title;
use Illuminate\Database\Seeder;

class TitleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $this->command->comment('Empezando ' . __CLASS__);

        $titles = [
            ['desc' => 'Licda.'],
            ['desc' => 'Dr.'],
            ['desc' => 'Dra.'],
            ['desc' => 'Ing.'],
        ];

        Title::insert($titles);
    }
}
