<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create multiple users
        DB::table('users')->insert([
            [
                'username' => 'gabriel@hotmail.com',
                'password' => bcrypt('Ch@rizard123'),
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'username' => 'lukas@hotmail.com',
                'password' => bcrypt('V@v1$123'),
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'username' => 'gessko@hotmail.com',
                'password' => bcrypt('sa@ai5454'),
                'created_at' => date('Y-m-d H:i:s')
            ],
        ]);
    }
}
