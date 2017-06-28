<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bill;

class PagesController extends Controller
{
    public function getDashboard()
    {
        $userid = Auth::id();
        $bills = Bill::where('user_id', $userid)->get();
        return view('pages.dashboard')->withBills($bills);
    }
}
