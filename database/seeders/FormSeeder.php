<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class FormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records = [
            [
                'name' => 'Account Master',
                'form_group' => 'Masters',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Group Master',
                'form_group' => 'Masters',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'HSN Master',
                'form_group' => 'Masters',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Item Master',
                'form_group' => 'Masters',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Item Group Master',
                'form_group' => 'Masters',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sale',
                'form_group' => 'Transactions',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Purchase',
                'form_group' => 'Transactions',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sale Return',
                'form_group' => 'Transactions',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Purchase Return',
                'form_group' => 'Transactions',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Receipt',
                'form_group' => 'Transactions',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Payment',
                'form_group' => 'Transactions',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'General',
                'form_group' => 'Transactions',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Contra',
                'form_group' => 'Transactions',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Stock In',
                'form_group' => 'Transactions',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Stock Out',
                'form_group' => 'Transactions',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Trail Balance',
                'form_group' => 'Reports',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ledger Report',
                'form_group' => 'Reports',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sales Register',
                'form_group' => 'Reports',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Purchase Register',
                'form_group' => 'Reports',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sale Return Report',
                'form_group' => 'Reports',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Purchase Return Report',
                'form_group' => 'Reports',
                'created_at' => now(),
                'updated_at' => now(),
            ]];
        foreach ($records as $record) {
            DB::table('forms')->insert($record);
        }
    }
}
