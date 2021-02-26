<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Let's create an administrator account 

        User::create([
        	'name' => 'Dimitris Chatzimichailidis',
        	'email' => 'info@dicha.gr',
        	'password' => bcrypt('password'),
        	'access_level' => User::ADMINISTRATOR_LEVEL
        ]);


        //Let's also create a non-administrator account even if we do not need it (just to demonstrate middleware protection this is a perfect example)

        User::create([
            'name' => 'Random User',
            'email' => 'randomuser@gmail.com',
            'password' => bcrypt('password'),
            'access_level' => User::NORMAL_LEVEL
        ]);

    }
}
