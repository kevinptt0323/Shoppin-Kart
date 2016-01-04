<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;
use App\Good;
use App\SoldGood;
use App\SoldGoodType;
use Carbon\Carbon;

class Order extends Model {
	protected $table = "orders";
	public $timestamps = false;
	public static function createOrder(array $data) {
		$order = new Order;

		DB::transaction(function() use (&$data, &$order) {
			$order->name = $data['inputData']['name'];
			$order->studentID = $data['inputData']['studentID'];
			$order->phone = $data['inputData']['phone'];
			$order->email = $data['inputData']['email'];
			$order->total = Order::getPrice($data['list']);
			$order->created_at = Carbon::now()->toDateTimeString();
			$order->save();

			$goodList = Order::getList($data['list']);

			foreach($goodList as $obj) {
				$soldGood = new SoldGood;
				$soldGood->gid = $obj['id'];
				$order->soldGoods()->save($soldGood);
				$soldGoodTypes = [];
				foreach ($obj['typeSelected'] as $tid) {
					$soldGoodType = new SoldGoodType;
					$soldGoodType->tid = $tid;
					array_push($soldGoodTypes, $soldGoodType);
				}
				$soldGood->types()->saveMany($soldGoodTypes);
			}
		});
		return $order;
	}

	private static function getList(&$list) {
		if(sizeof($list)==0) return [];
		$ret = [];
		foreach($list as $obj) {
			array_push($ret, [
				'id' => $obj['id'],
				'typeSelected' => isset($obj['typeSelected'])&&is_array($obj['typeSelected']) ? $obj['typeSelected'] : []
			]);
		}
		foreach($list as $obj) {
			$ret = array_merge($ret, Order::getList($obj['childObj']));
		}
		return $ret;
	}

	private static function getPrice(&$list) {
		$goods = Good::getGoods();
		$ret = 0;
		foreach($list as &$obj) {
			foreach($goods as &$good) {
				if ($good['id'] == $obj['id']) {
					if (isset($good['special']))
						$ret += $good['special'];
					else
						$ret += $good['price'];
				}
			}
		}
		return $ret;
	}

	public function soldGoods() {
		return $this->hasMany('App\SoldGood', 'oid');
	}

	public function setUpdatedAtAttribute($value) {
	}
}
