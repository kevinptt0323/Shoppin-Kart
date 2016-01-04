<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SoldGood extends Model {
	protected $table = "sold-goods";
	public $timestamps = false;

	public function types() {
		return $this->hasMany('App\SoldGoodType', 'sgid');
	}
	public function good() {
		return $this->hasOne('App\Good', 'id', 'gid')->select(['name']);
	}
	protected $hidden = ['id', 'oid', 'gid'];
}
