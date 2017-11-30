<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		for($i = 1 ; $i <= 50 ; $i++) {
			$name = str_random(5);
			$des = 'This is product ' . $name . ' Descripiton Content.....';
			$cover = ['5a1651223208f.jpg', '5a1d35c847c4b.jpg', '5a1d372e0f2e0.jpg'];

			DB::table('product')->insert([
				'name' => $i,
				'category_id' => 7,
				'priority' => $i,
				'description' => $des,
				'cover' => $cover[rand(0,2)],
				'content' => $des,
				'model' => 'model',
				'standard' => 'standard',
				'material' => 'material',
				'produce_time' => 'produce_time',
				'lowest' => 'lowest',
				'memo' => 'memo',
				'tags' => 'tags',
				'status_record' => 'open',
				'modify_id' => 1,
				'status' => 'open',
			]);
		}
    }
}
