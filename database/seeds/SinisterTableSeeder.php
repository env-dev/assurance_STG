<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Sinister;

class SinisterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 2; $i++) { 
            $sinister = new Sinister;

            $sinister->data_flow = Carbon::now();
            $sinister->date_sinister = Carbon::yesterday();
            $sinister->place_sinister = 'Tanger';
            $sinister->cause_sinister = 'Noyade';
            $sinister->client_id = $i + 1;
            $sinister->smartphone_id = $i + 1;
            $sinister->status = 0;

            $sinister->save();
        }
    }
}
