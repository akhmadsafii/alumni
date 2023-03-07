<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MajorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('majors')->insert([
            [
                'code' => 'teknik-pemesinan-zwidx',
                'name' => 'Teknik Pemesinan',
                'status' => 1,
                'created_at' => now()
            ],
            [
                'code' => 'teknik-industri-zwirx',
                'name' => 'Teknik Industri',
                'status' => 1,
                'created_at' => now()
            ],
            [
                'code' => 'teknik-otomotif-zwidx',
                'name' => 'Teknik Otomotif',
                'status' => 1,
                'created_at' => now()
            ],

        ]);
    }
}
