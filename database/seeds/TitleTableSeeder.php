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
            'Licda.',
            'Dr.',
            'Dra.',
            'Ing.',
        ];

        foreach ($titles as $title) {
            Title::create([
                'desc' => $title,
            ]);
        }
    }
}
