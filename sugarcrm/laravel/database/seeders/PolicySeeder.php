<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PolicySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lt_policy')->insert([
            [
                'name' => 'Policy 1',
                'description' => 'This is policy 1',
                'customer_id' => 1,
                'active' => 1
            ],
            [
                'name' => 'Policy 2',
                'description' => 'This is policy 2',
                'customer_id' => 1,
                'active' => 1
            ],
            [
                'name' => 'Policy 3',
                'description' => 'This is policy 3',
                'customer_id' => 2,
                'active' => 1
            ],
            [
                'name' => 'Policy 4',
                'description' => 'This is policy 4',
                'customer_id' => 6,
                'active' => 1
            ],
            [
                'name' => 'Policy 5',
                'description' => 'This is policy 5',
                'customer_id' => 6,
                'active' => 1
            ],
            [
                'name' => 'Policy 6',
                'description' => 'This is policy 6',
                'customer_id' => 6,
                'active' => 1
            ],
            [
                'name' => 'Policy 7',
                'description' => 'This is policy 7',
                'customer_id' => 6,
                'active' => 1
            ]
        ]);
    }
}
