<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Technology;
use App\Models\Project;
use App\Models\User;

class DashboardController extends Controller
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
        return view('admin.dashboard', [
            'total_projects' => Project::all()->count(),
            'total_users' => User::all()->count(),
            'last_projects' => Project::orderByDesc('id')->limit(3)->get(),
            'technologies_counter' => Technology::all()->count(),
        ]);
    }
}
