<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class System extends Model
{
    protected $table = 'system';

	public function getSystem()
	{
		$product = System::first();

		return json_decode($product, true);
    }
}
