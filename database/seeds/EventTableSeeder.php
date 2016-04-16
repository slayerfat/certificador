<?php

use App\Event;
use App\PersonalDetail;
use App\Professor;
use Illuminate\Database\Seeder;

class EventTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->comment('Empezando ' . __CLASS__);

        /** @var Event[] $events */
        $events = factory(Event::class, 3)->create();

        foreach ($events as $event) {
            $this->command->info("Uniendo Evento $event->id con Usuarios.");
            $users = factory(PersonalDetail::class, 30)->create();
            $ids   = $users->keyBy('id')->keys()->all();
            foreach ($ids as $id) {
                $event->attendants()->attach($id, [
                    'approved' => rand(0, 3) > 0 ? true : false,
                ]);
            }

            $this->command->info("Uniendo Evento $event->id con Profesor.");
            $prof = factory(Professor::class)->create();

            $event->professors()->attach($prof->id);
        }
    }
}
