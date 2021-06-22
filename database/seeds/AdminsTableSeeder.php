<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->delete();
        $adminRecords = [
            'id' =>1, 'name'=>'Kishor Pun Magar', 'number'=>'98523454', 'email' =>'kishorpun55@gmail.com', 'password' =>'$2y$10$QBsWw1bMwjm6PZ5ZKsxHu.WX2g3NK2DuvMXBDQPPF27jaQeqgNgoe', 'image' =>'werewr', 'type'=>'Admin'
        ];

        \App\Admin\Admin::create($adminRecords);
    }
}
