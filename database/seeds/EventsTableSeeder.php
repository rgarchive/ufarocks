<?php

use Illuminate\Database\Seeder;
use App\Event;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('events')->delete();

        Event::create([
            'name'          => 'Концерт Scooter в Уфе',
            'description'   => 'Легендарная группа Scooter в рамках юбилейного тура в РК Огни Уфы.',
            'image'         => null,
            'venue_id'      => 5,
            'artist_id'     => null,
            'starts_at'     => '2018-11-04',
        ]);
    }
}
