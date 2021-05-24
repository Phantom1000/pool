<?php

namespace Database\Seeders;

use App\Models\Entry;
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
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(HallSeeder::class);
        $this->call(ScheduleSeeder::class);
        // Entry::factory()->count(20)->create();
    }
}
