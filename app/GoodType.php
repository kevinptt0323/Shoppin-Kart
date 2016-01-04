<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GoodType extends Model
{
	protected $table = "good-types";
	public static function getGoodTypes($id) {
		$goodTypes = GoodType::where('gid', $id)->orderBy('type_group')->get(['id', 'type_group', 'name'])->groupBy('type_group');
		return sizeof($goodTypes)==0 ? null : $goodTypes;
	}
	public function types() {
		return $this->belongsTo('GoodType');
	}

	protected $hidden = ['type_group', 'gid'];
}
