<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PredictionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('predictions')->delete();
        \App\Prediction::create([
            'user_id' => 1,
            'match_id' => 1,
            'home_score' => 1,
            'away_score' => 0,
        ]);
    }
}
