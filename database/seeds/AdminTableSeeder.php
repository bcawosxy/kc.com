<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin')->insert([
            'account' => 'admin',
            'password' => Hash::make('123456'),
            'name' => 'admin',
            'email'    => 'admin@mail.com',
            'modify_id' => 1,
            'updated_at'  => '2017-12-11 00:00:00',
            'ip' => '1.1.1.1',
        ]);
    }
}
