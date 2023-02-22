<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    Post, Category, Tag, File
};

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
        $dbChartData = Post::selectRaw('year(created_at) year, monthname(created_at) month, count(*) data')
        ->groupBy('year', 'month')
        ->orderBy('year', 'desc')
        ->get();
        $month_name =  array_column($dbChartData->toArray(), 'month');
        $year_name =  array_column($dbChartData->toArray(), 'year');
        $datas =  array_column($dbChartData->toArray(), 'data');

        $totalPost = Post::get()->count();
        $totalCategory = Category::get()->count();
        $totalTag = Tag::get()->count();
        $totalFile = File::get()->count();

        return view('backend.pages.dashboard', compact('dbChartData', 'month_name','year_name', 'datas', 'totalFile', 'totalTag', 'totalPost', 'totalCategory'));
    }
}
