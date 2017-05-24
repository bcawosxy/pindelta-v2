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
            'account' => str_random(5),
            'password' => Hash::make('password'),
            'name' => str_random(10),
            'email'    => str_random(10).'@mail.com',
            'modify_time'    => '2015-04-03 03:13:30',
            'ip' => '1.1.1.1',
        ]);
    }
}
