<?php

use Illuminate\Database\Seeder;

class CategoryareaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
	{
    	for($i = 1 ; $i <= 30 ; $i++) {
    		$name = str_random(15);
    		$des = 'This is '.$name. ' Descripiton Content.....';

			DB::table('categoryarea')->insert([
				'name' => $name,
				'priority' => $i,
				'description' => $des,
				'cover' => '593a6cb920a41.jpg',
				'modify_id' => 1,
				'status' => 'open',
			]);
		}
    }
}
