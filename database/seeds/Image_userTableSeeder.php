<?php

use Illuminate\Database\Seeder;

class Image_userTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {       
        for ($i=1; $i < 4; $i++) 
        { 
            DB::table('image_user')->insert([
                'alert' => 1,
                'user_id' => 1,
                'image_id' => $i,
            ]);
            DB::table('image_user')->insert([
                'alert' => 1,
                'user_id' => 2,
                'image_id' => $i,
            ]);
        }

        DB::table('image_user')->insert([
            'alert' => 1,
            'user_id' => 1,
            'image_id' => 9,
        ]);
      
    }
}
