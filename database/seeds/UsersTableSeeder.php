<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.ca',
            'email_verified_at'=> Carbon::now(),
            'password' => bcrypt('123456'),
            'role' => 'admin',
        ]);


        User::create([
            'name' => 'User1',
            'email' => 'user1@user1.ca',
            'email_verified_at'=> Carbon::now(),
            'password' => bcrypt('123456'),
            'role' => 'user',
        ]);

        User::create([
            'name' => 'User2',
            'email' => 'user2@user2.ca',
            'email_verified_at'=> Carbon::now(),
            'password' => bcrypt('123456'),
            'role' => 'user',
        ]);
    }
}
