<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usernames = ['user', 'admin', 'seller', 'control', 'trainer', 'staff'];
        $surnames = ['Сидоров', 'Федоров', 'Петров', 'Алексеев', 'Антонов', 'Борисов'];
        $names = ['Петр', 'Антон', 'Денис', 'Петр', 'Сергей', 'Глеб'];
        $patronymics = ['Иванович', 'Ильич', 'Антонович', 'Игоревич', 'Петрович', 'Артемович'];

        for ($i = 0, $n = count($usernames); $i < $n; $i++) {
            $user = User::create([
                'username' => $usernames[$i],
                'surname' => $surnames[$i],
                'name' => $names[$i],
                'patronymic' => $patronymics[$i],
                'email' => "$usernames[$i]@example.com",
                'password' => Hash::make('123'),
                'email_verified_at' => now(),
            ]);
            if ($i > 0) {
                $user->roles()->attach($i + 1);
            }
        }
    }
}
