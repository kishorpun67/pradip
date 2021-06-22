<?php

use Illuminate\Database\Seeder;

class SectionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $section = [
            [
                'id' =>1,
                'name' => 'Men',
                'status' =>1,
            ],
            [
                'id' =>2,
                'name' => 'Women',
                'status' =>1,
            ],
            [
                'id' =>3,
                'name' => 'Kids',
                'status' =>1,
            ],
        ];
        \App\Admin\Section::insert($section);
    }
}
