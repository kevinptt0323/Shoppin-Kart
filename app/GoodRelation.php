<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GoodRelation extends Model
{
	protected $table = "good-relations";
	public static function getChildGoods($id) {
		$goods = GoodRelation::where('gid', $id)->orderBy('cid')->get(['cid']);
		$goods2 = [];
		foreach($goods as $good) {
			array_push($goods2, $good->cid);
		}
		return sizeof($goods2)==0 ? null : $goods2;
	}
}
