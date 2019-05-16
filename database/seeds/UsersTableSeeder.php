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
        for ($i=1; $i < 10; $i++) 
        { 
            User::create([
                'name' => 'User'.$i.'',
                'email' => 'user'.$i.'@user'.$i.'.ca',
                'email_verified_at'=> Carbon::now(),
                'password' => bcrypt('123456'),
                'role' => 'user',
            ]);
        }
    }
}
