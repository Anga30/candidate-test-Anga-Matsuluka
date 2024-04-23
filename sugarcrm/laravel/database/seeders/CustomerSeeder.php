<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lt_customers')->insert([
            [
                'first_name' => 'Matome',
                'last_name' => 'Sefela',
                'description' => 'This is customer 1',
                'id_number' => '9112120000000',
            ],
            [
                'first_name' => 'King',
                'last_name' => 'Monada',
                'description' => 'This is customer 2',
                'id_number' => '7501010000000',
            ],
            [
                'first_name' => 'James',
                'last_name' => 'Wilson',
                'description' => 'This is customer 3',
                'id_number' => '7708160000000',
            ],
            [
                'first_name' => 'Frank',
                'last_name' => 'Joseph',
                'description' => 'This is customer 4',
                'id_number' => '7908160 000000',
            ],
            [
                'first_name' => 'Thulani',
                'last_name' => 'Msweli',
                'description' => 'This is customer 5',
                'id_number' => '560 8160000000',
            ],
            [
                'first_name' => 'Harris',
                'last_name' => 'Bey',
                'description' => 'This is customer 6',
                'id_number' => '65081609000005',
            ]
        ]);
    }
}
