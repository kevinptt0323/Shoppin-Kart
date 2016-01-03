<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SoldGoodType extends Model {
	protected $table = "sold-good-types";
	public $timestamps = false;

	public function sgid() {
		return $this->belongsTo('SoldGood');
	}
	public function tid() {
		return $this->belongsTo('GoodType');
	}
}
