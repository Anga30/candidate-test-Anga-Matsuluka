<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomersCasesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers_cases')->insert([
            [
                'customer_id' => 1, 'case_id' => 1
            ],
            [
                'customer_id' => 1, 'case_id' => 2
            ],
            [
                'customer_id' => 1, 'case_id' => 3
            ],
            [
                'customer_id' => 2, 'case_id' => 2
            ],
            [
                'customer_id' => 3, 'case_id' => 2
            ],
        ]);
    }
}
