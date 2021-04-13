<?php

use App\User;
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
        $user = User::create([
            'name' => 'Daniel Lopez',
            'email' => 'dlopezs2009@hotmail.com',
            'password' => Hash::make('daniellopez22'),
        ]);

        $user = User::create([
            'name' => 'Sistemas',
            'email' => 'sistemas@deltronicsperu.com',
            'password' => Hash::make('%sistemas2020%'),
        ]);
    }
}
