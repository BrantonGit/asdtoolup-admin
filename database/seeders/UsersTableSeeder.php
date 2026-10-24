<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;
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
        DB::table('users')->insert([
        //Masters
        [
            'email' => 'lucas@branton.ca',
            'password' => bcrypt('branton'),
            'role' => 2,
            'fname' => 'Lucas',
            'lname' => 'McCallum',
            'phone' => '519-471-6778',
            'profession' => 'Full-Stack Developer',
            'company'=>'Branton',
            'address' => '1057 Oxford St. West',
            'city' => 'London',
            'postal' => 'N6H 1V6',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'notifications' => 1
        ],
        [
            'email' => 'jessy@branton.ca',
            'password' => bcrypt('branton'),
            'role' => 2,
            'fname' => 'Jessy Vander',
            'lname' => 'Vart',
            'phone' => '519-471-6778',
            'profession' => 'Full-Stack Developer',
            'company'=>'Branton',
            'address' => '1057 Oxford St. West',
            'city' => 'London',
            'postal' => 'N6H 1V6',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'notifications' => 1
        ],
        [
            'email' => 'rodney@branton.ca',
            'password' => bcrypt('branton'),
            'role' => 2,
            'fname' => 'Rodney',
            'lname'=>'Hagle',
            'phone' => '519-471-6778',
            'profession' => 'Full-Stack Developer',
            'company'=>'Branton',
            'address' => '1057 Oxford St. West',
            'city' => 'London',
            'postal' => 'N6H 1V6',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'notifications' => 1
        ],

        // Admins
        [
            'email' => 'ryan@branton.ca',
            'password' => bcrypt('branton'),
            'role' => 1,
            'fname' => 'Ryan',
            'lname'=>'Campbell',
            'phone' => '519-471-6778',
            'profession' => 'Content Marketing Specialist',
            'company'=>'Branton',
            'address' => '1057 Oxford St. West',
            'city' => 'London',
            'postal' => 'N6H 1V6',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'notifications' => 1
        ],
        //Customers
        [
            'email' => 'test@branton.ca',
            'password' => bcrypt('branton'),
            'role' => 0,
            'fname' => 'John',
            'lname' => 'Smith',
            'phone' => '283-600-8391',
            'profession' => 'Test Customer',
            'company'=>'A Fake Company',
            'address' => '89 Manchester Ave',
            'city' => 'Los Angeles',
            'postal' => 'Y2H 1R4',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'notifications' => 1
        ],

        ]);

    }
}
