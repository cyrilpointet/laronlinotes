<?php

namespace Database\Seeders;

use App\Models\Note;
use Illuminate\Database\Seeder;

class NotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Note::truncate();

        $faker = \Faker\Factory::create();

        for ($i=0; $i<10; $i++) {
            Note::create([
                'content' => $faker->paragraph,
                'user_id' => 1,
            ]);
        }
    }
}
