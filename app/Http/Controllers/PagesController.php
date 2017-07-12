<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bill;
use App\BillImage;
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
        $billimgs = [];
        foreach($bills as $key => $bill)
        {
            $billimgs[$key] = BillImage::where('bill_id', '=', $bill->id)->get();
        }
        $billsinfo['bills'] = $bills;
        $billsinfo['billimgs'] = $billimgs;
        return view('pages.dashboard')->withBillsinfo($billsinfo);
    }
}
