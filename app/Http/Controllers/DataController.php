<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Excel;
use PDF;
use Carbon\Carbon;

class DataController extends Controller
{
    public function index(){
		return view('data');
	}
	public function  store(Request $request){
		$excel = Excel::all();
        return response()->json($excel);
	}
	public function show($id){
		$user =  Excel::find($id);
        if (!$user)
            return redirect('/')
                ->header('Content-Type', 'text/plain');
		$year = Carbon::parse($user->created_at)->year;
		$month = Carbon::parse($user->created_at)->month;
		$day = Carbon::parse($user->created_at)->day;
		$date = $year."/".$month."/".$day;
		$monthYear = date('F', strtotime($user->created_at)).",".$year; 
        $pdf = PDF::loadView('layouts.pdf', compact('user','monthYear','date'));
        return $pdf->stream('disney.pdf');
	}
	public function one(){
		echo "Hello";
	}
}
