<?php

namespace Database\Seeders;

use App\Models\Hall;
use Illuminate\Database\Seeder;

class HallSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = ['Первый', 'Второй', 'Большой', 'Малый', 'VIP'];
        $floors = [1, 1, 1, 2, 2];
        $lanes = [5, 4, 8, 3, 3];
        $places = [3, 5, 3, 3, 3];

        for ($i = 0, $n = count($names); $i < $n; $i++) {
            Hall::create([
                'name' => $names[$i],
                'floor' => $floors[$i],
                'lanes' => $lanes[$i],
                'places' => $places[$i]
            ]);
        }
    }
}
