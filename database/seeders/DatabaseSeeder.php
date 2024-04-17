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
        $this->call(UserSeeder::class);
        $this->call(CompanySeeder::class);
        $this->call(EmployeeSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(SupplierSeeder::class);
        $this->call(RegionalSeeder::class);
        $this->call(DivisionSeeder::class);
        $this->call(AssetSeeder::class);
        // \App\Models\User::factory(10)->create();
    }
}
