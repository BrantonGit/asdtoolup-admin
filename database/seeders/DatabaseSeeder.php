<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PaymentMethodsTableSeeder::class);        
        $this->call(PaymentStatusesTableSeeder::class);
        $this->call(StatusesTableSeeder::class);   
        $this->call(UsersTableSeeder::class);
        $this->call(ReasonsTableSeeder::class);
        $this->call(ProductCategoriesTableSeeder::class);
        $this->call(BrandsTableSeeder::class);
    }
}
