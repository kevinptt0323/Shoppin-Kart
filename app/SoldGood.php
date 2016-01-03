<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SoldGood extends Model {
	protected $table = "sold-goods";
	public $timestamps = false;

	public function oid() {
		return $this->belongsTo('Order');
	}
	public function gid() {
		return $this->belongsTo('Goods');
	}
	public function types() {
		return $this->hasMany('App\SoldGoodType', 'sgid');
	}
}
