<?php

namespace Database\Seeders;

use App\Models\App;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = App::factory()->count(100)->create();   //panggil semula fail AppFactory count- berapa byk row nak generate, create akan masuk dalam table
        dd ('success');
    }
}
