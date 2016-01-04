<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SoldGoodType extends Model {
	protected $table = "sold-good-types";
	public $timestamps = false;

	public function type() {
		return $this->hasOne('App\GoodType', 'id', 'tid')->select(['name']);
	}

	protected $hidden = ['id', 'sgid', 'tid'];
}
