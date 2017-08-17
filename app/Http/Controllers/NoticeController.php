<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notice;
use Auth;

class NoticeController extends Controller
{
	public function get(Request $request)
	{
		$notice = Notice::where('date', '=', $request->date)->first();
		$res = [
			'msg'	=> 'Объявления загружены',
			'ok'	=> true
		];
		
		if ($notice) {
			$res['data'] = $notice->data;
		}

		return response()->json($res);
	}

    public function save(Request $request)
	{
		if (!Auth::check()) return response()->json(['msg' => 'У Вас нет прав!']);

		$notice = Notice::where('date', '=', $request->date)->firstOrNew([]);
		$notice->fill($request->all());
		$notice->save();
		
		return response()->json([
			'msg'	=> 'Объявления сохранены',
			'ok'	=> true
		]);
	}
	
	public function edit($date = null)
	{
		abort_unless(Auth::check(), 403);
		if (empty($date)) $date = date('Y-m-d');

		return view('notices.edit')->with([
			'date'			=> $date,
			'controller'	=> 'NoticeController',
			'edit'			=> true
		]);
	}
	
	public function view($date = null)
	{
		if (empty($date)) $date = date('Y-m-d');

		return view('notices.view')->with([
			'date'			=> $date,
			'controller'	=> 'NoticeController'
		]);
	}
}
