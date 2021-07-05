<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'      => 'Cheryl',
            'email'     => 'cheryl0821@outlook.com',
            'password'  => Hash::make('password')
        ]);
        DB::table('users')->insert([
            'name'      => 'notMutualFriendChandler',
            'email'     => 'chandler1@doublebery.com',
            'password'  => Hash::make('password')
        ]);
        DB::table('users')->insert([
            'name'      => 'MutualFriendChandler',
            'email'     => 'chandler2@doubleberry.com',
            'password'  => Hash::make('password')
        ]);
    }
}
