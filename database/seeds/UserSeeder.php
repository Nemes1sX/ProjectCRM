<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@mail.com',
                'password' => Hash::make('Admin12'),
                'role' => 'IT engineer',
                'status' => 1,
            ],
            [
                'name' => 'Jonas Jonaitis',
                'email' => 'jonas@mail.com',
                'password' => Hash::make('Jonas'),
                'role' => 'IT engineer',
                'status' => 2,
            ],
            [
                'name' => 'Martinas',
                'email' => 'martinas@mail.com',
                'password' => Hash::make('Martinas'),
                'role' => 'Software engineer',
                'status' => 2,
            ],
            [
                'name' => 'Petras Petraitis',
                'email' => 'petras@mail.com',
                'password' => Hash::make('Petras'),
                'role' => 'Software engineer',
                'status' => 2,
            ],
            [
                'name' => 'Vardenis',
                'email' => 'vardenis@mail.com',
                'password' => Hash::make('Vardenis'),
                'role' => 'Manager',
                'status' => 2,
            ],
            [
                'name' => 'Pavardenis',
                'email' => 'pavardenis@mail.com',
                'password' => Hash::make('Pavardenis'),
                'role' => 'Manager',
                'status' => 2,
            ],
        ];
        foreach($users as $user){
            \App\User::create($user);
        }
    }
}
