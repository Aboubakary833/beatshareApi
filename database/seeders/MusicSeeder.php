<?php

namespace Database\Seeders;

use App\Models\Music;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MusicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Music::create([
            'uuid' => Str::uuid(),
            'name' => 'Polaroïde de Youssoufa',
            'picture' => 'default.png',
            'visibility' => true,
            'userId' => 1
        ]);
    }
}
