<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;

class ReasonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('reasons')->insert([
        [
            'reason' => 'None'
        ],
        [
            'reason' => 'Insufficient Info'
        ],
        [
            'reason' => 'Other'
        ],
        ]);
    }
}
