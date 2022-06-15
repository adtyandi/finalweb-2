<?php

namespace App\Http\Controllers;

use App\Models\Kredit;
use App\Models\User;
use Illuminate\Http\Request;

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
        $total_pengguna = User::all()->count();
        $total_pengajuan = Kredit::all()->count();
        return view('home', compact('total_pengguna', 'total_pengajuan'));
    }
}
