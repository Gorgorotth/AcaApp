<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Garage;
use App\Models\GarageEmail;
use App\Models\Invoice;
use App\Models\Mechanic;
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
        // \App\Models\User::factory(10)->create();
        Mechanic::factory(1)->create([
            'name' => 'Kurbla',
            'garage_id' => 1,
            'email' => 'acdc@g.c',
        ]);

        Admin::factory(1)->create([
            'name' => 'Admin',
            'email' => 'acdc1@g.c'
        ]);

        Garage::factory(1)->create([
            'name' => 'Yugo',
            'hourly_rate' => 22.90,
        ]);

        GarageEmail::factory(10)->create([
            'garage_id' => 1,
        ]);
    }
}
