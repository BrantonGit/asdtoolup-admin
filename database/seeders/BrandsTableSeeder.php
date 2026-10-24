<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('brand')->insert([
            [
                'name' => 'NSA'
            ],
            [
                'name' => 'Honeywell'
            ],
            [
                'name' => 'Other'
            ]
        ]);
    }
}
