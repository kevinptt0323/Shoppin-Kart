<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GoodType extends Model
{
	protected $table = "good-types";
	public static function getGoodTypes($id) {
		$goodTypes = GoodType::where('gid', $id)->orderBy('t_type')->get(['id', 't_type', 'type'])->groupBy('t_type');
		return sizeof($goodTypes)==0 ? null : $goodTypes;
	}
}
