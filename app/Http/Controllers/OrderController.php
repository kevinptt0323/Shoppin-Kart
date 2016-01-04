<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use Response;
use Validator;
use App\Http\Requests;
use App\Http\Requests\OrderRequest;
use App\Http\Controllers\Controller;
use App\Order;

class OrderController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		if (1) {
			$orders = Order::all();
			return Response::json([
				'message' => 'OK',
				'data' => $orders
			], 200);
		}
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(OrderRequest $request)
	{
		$data = $request->all();

		$rules = [
			'inputData.name' => 'required',
			'inputData.studentID' => 'required',
			'inputData.phone' => 'required',
			'inputData.email' => 'required',
			'list' => 'required|array|each_exists:id'
		];
		$messages = [
			'required' => '欄位不可為空白',
			'array' => '欄位不可為空白',
		];
		$validator = Validator::make($data, $rules, $messages);

		if ($validator->passes()) {
			$ret = Order::createOrder($data);
			if ($ret) {
				return Response::json([
					'message' => '下單成功',
					'data' => [
						'id' => $ret->id,
						'total' => $ret->total,
					]
				]);
			} else {
				return Response::json([
					'message' => '驗證錯誤',
					'data' => '未知的錯誤'
				], 400);
			}
		} else {
			return Response::json([
				'message' => '驗證錯誤',
				'data' => $validator->errors()
			], 400);
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$ret = Order::find($id);
		if ($ret) {
			foreach($ret->goods as &$soldGood) {
				$soldGood->good;
				foreach($soldGood->types as &$type) {
					$type->type;
				}
			}

			return Response::json([
				'message' => 'OK',
				'data' => $ret
			], 200);
		} else {
			return Response::json([
				'message' => 'Not Found',
				'data' => []
			], 404);
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		//
	}

	public function updateAction($id, Request $req) {
		$data = $req->all();
		if ($data['action']=="delete") {
			Order::destroy($data['id']);
			return Response::json([
			'message' => 'OK',
			'data' => []
			], 200);
		}
		$order = Order::find($data['id']);
		$date = new Carbon();
		if ($data['action']=="paid") {
			$order->paid_at = $date->toDateTimeString();
		}
		if ($data['action']=="picked") {
			$order->picked_at = $date->toDateTimeString();
		}
		$order->save();
		return Response::json([
			'message' => 'OK',
			'data' => $order
		], 200);
	}
}
