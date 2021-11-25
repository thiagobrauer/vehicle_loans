<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class VechiclesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Vehicle::create([
            'name' => 'Fiat Argo',
            'amount' => 4250000
        ]);

        Vehicle::create([
            'name' => 'Hyundai HB20',
            'amount' => 3500090
        ]);

        Vehicle::create([
            'name' => 'Chevrolet Onix',
            'amount' => 7033000
        ]);

        Vehicle::create([
            'name' => 'Volkswagen Gol',
            'amount' => 6875000
        ]);
    }
}
