<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Location;

class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        // We insert some dummy data
        $locations = array('Ottawa', 'Varadero', 'Jamaïque','Thaïlande', 'Cancun', 'Cannes', 'Montréal', 'Rome', 'Barcelone', 'Québec');


        for ($i=0; $i < 10; $i++) 
        { 
            DB::table('locations')->insert([
                'name' => $locations[$i],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
    }

}
