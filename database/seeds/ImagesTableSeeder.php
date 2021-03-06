<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Image;

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        for ($i=1; $i < 10; $i++) 
        { 
            DB::table('images')->insert([
                'location_id' => $i,
                'user_id' => $i,
                'name' => 'placeholder_'.$i.'.jpeg',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
            
            $j = $i + 10;
            DB::table('images')->insert([
                'location_id' => $i,
                'user_id' => $i,
                'name' => 'placeholder_'.$j.'.jpeg',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
        
    }
}
