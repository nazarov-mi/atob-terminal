<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Schedule;
use Auth;

class ScheduleController extends Controller
{
	public function get(Request $request)
	{
		$sch = Schedule::where('date', '=', $request->date)->first();
		$res = [
			'msg'	=> 'Расписание загружено',
			'ok'	=> true
		];
		
		if ($sch) {
			$res['data'] = $sch->data;
		}

		return response()->json($res);
	}
	
	public function save(Request $request)
	{
		if (!Auth::check()) return response()->json(['msg' => 'У Вас нет прав!']);

		$sch = Schedule::where('date', '=', $request->date)->firstOrNew([]);
		$sch->fill($request->all());
		$sch->save();
		
		return response()->json([
			'msg'	=> 'Расписание сохранено',
			'ok'	=> true
		]);
	}
	
	public function edit($date = null)
	{
		abort_unless(Auth::check(), 403);
		if (empty($date)) $date = date('Y-m-d');

		return view('schedule.edit')->with([
			'date'			=> $date,
			'controller'	=> 'ScheduleController',
			'edit'			=> true
		]);
	}
	
	public function view($date = null)
	{
		if (empty($date)) $date = date('Y-m-d');

		return view('schedule.view')->with([
			'date'			=> $date,
			'controller'	=> 'ScheduleController'
		]);
	}
}
