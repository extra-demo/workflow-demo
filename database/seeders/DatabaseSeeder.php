<?php

namespace Database\Seeders;

use App\Models\TiAn;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        TiAn::factory(10)->create();
    }
}
