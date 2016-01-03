<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\GoodRelation;
use App\GoodType;

class Good extends Model {
	protected $table = "goods";
	public static function getGoods() {
		$goods = Good::all();
		foreach($goods as &$good) {
			$good->child = GoodRelation::getChildGoods($good->id);
			$good->types = GoodType::getGoodTypes($good->id);
		}
		return $goods;
	}
}
