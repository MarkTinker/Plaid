<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bill;
use Auth;

class PagesController extends Controller
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

    public function getDashboard()
    {
        $userid = Auth::id();
        $bills = Bill::where('user_id', $userid)->get();
        return view('pages.dashboard')->withBills($bills);
    }
}
