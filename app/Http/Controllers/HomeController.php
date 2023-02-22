<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $dbChartData = Post::where('created_at', DB::raw(''))->get()->count();
        $dbChartData = Post::selectRaw('year(created_at) year, monthname(created_at) month, count(*) data')
        ->groupBy('year', 'month')
        ->orderBy('year', 'desc')
        ->get()->toArray();
        // return $dbChartData;
         $month_name =  json_encode(array_column($dbChartData, 'month'));
        $datas =  json_encode(array_column($dbChartData, 'data'));
        return view('backend.pages.dashboard', compact('dbChartData', 'month_name', 'datas'));
    }
}
