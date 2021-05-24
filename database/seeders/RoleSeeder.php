<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = ['Пользователь', 'Администратор', 'Продавец', 'Контроллер', 'Тренер', 'Персонал'];
        $slugs = ['user', 'admin', 'seller', 'controller', 'trainer', 'staff'];

        for ($i = 0, $n = count($names); $i < $n; $i++) {
            Role::create([
                'name' => $names[$i],
                'slug' => $slugs[$i]
            ]);
        }
    }
}
