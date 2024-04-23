<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lt_cases')->insert([
            [
                'name' => 'Case 1',
                'description' => 'This is case 1',
                'case_id' => null,
                'policy_id' => 1,
                'type' => 'increase_cover',
                'status'=>  'open'
            ],
            [
                'name' => 'Case 2',
                'description' => 'This is case 2',
                'case_id' => 1,
                'policy_id' => 2,
                'type' => 'decrease_cover',
                'status'=>  'open'
            ],
            [
                'name' => 'Case 3',
                'description' => 'This is case 3',
                'case_id' => 1,
                'policy_id' => 3,
                'type' => 'cancel_cover',
                'status'=>  'open'
            ]
        ]);
    }
}
