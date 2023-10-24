<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Faker\Factory as Faker;

class NotesTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($userId = 1; $userId <= 10; $userId++) {
            for ($noteIndex = 1; $noteIndex <= 5; $noteIndex++) {
                DB::table('notes')->insert([
                    'id_user' => $userId,
                    'judul' => $faker->sentence,
                    'isi' => $faker->paragraph,
                    'tanggal' => $faker->date,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
    }
}
