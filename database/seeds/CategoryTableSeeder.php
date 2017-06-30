<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		for($i = 1 ; $i <= 30 ; $i++) {
			for($j = 1 ; $j < 3 ; $j++) {
				$name = str_random(10);
				$des = 'This is category ' . $name . ' Descripiton Content.....';

				DB::table('category')->insert([
					'name' => $name,
					'categoryarea_id' => $i,
					'priority' => $j,
					'description' => $des,
					'cover' => '5937a6fdc90df.jpg',
					'status_record' => 'open',
					'modify_id' => 1,
					'status' => 'open',
				]);
			}
		}
    }
}
