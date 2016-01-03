<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
		//
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
			'list' => 'required|array|each_exists:id,childObj'
		];
		$messages = [
			'required' => '欄位不可為空白',
			'array' => '欄位不可為空白',
		];
		$validator = Validator::make($data, $rules, $messages);

		if ($validator->passes()) {
			return Response::json([
				'message' => '下單成功',
				'data' => [ 'id' => 1 ]
			]);
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
		//
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
}
