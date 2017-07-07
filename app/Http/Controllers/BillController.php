<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bill;
use Auth;
use Session;


class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource. Step-1
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bill.create');
    }

    /**
      * SShow the from for creating a new bill Step-2
      *
      */
    
    public function createStep2()
    {
        return view('bill.create2');
    }
    /**
     * Store a newly created resource in storage. Step-1
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
            'billname'      => 'required|max:191',
            'duedate'       => 'required|date:after',
            'amount'        => 'required|numeric'
            
        ));

        $bill = new Bill();
        $bill->user_id = Auth::id();
        $bill->bill_name = $request->billname;
        $newDate = date("Y-m-d", strtotime($request->duedate));
        $bill->due_date = $newDate;
        $bill->status = 0;
        $bill->amount = $request->amount;        
        $bill->save();

        // Show the Add Bill Step-2
        return view('bill.create2')->withBillinfo($bill);
    }

    /**
     * Store a newly created resource in storage. Step-2
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeStep2(Request $request)
    {
        //
        $this->validate($request, array(
            'bill_id'           => 'required|numeric',
            'payment_option'    => 'required|max:191'
        ));

        $bill = Bill::find($request->bill_id);
        if ($bill != null)
        {        
            $bill->payment_option = $request->payment_option;
            $bill->save();
            $billInfo['bill'] = $bill;
            return view('bill.create3')->withBillinfo($billInfo);            
        }
        else
        {
            Session::flash('errmsg', "Add Bill Failed");
            return redirect()->route('pages.dashboard');
        }
        
    }

    /**
     * Store a newly created resource in storage. Step-3 Change Status In Review
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeStep3(Request $request)
    {
        $this->validate($request, array(
            'bill_id'      => 'required|numeric'
        ));


        $bill = Bill::find($request->bill_id);        
        if($bill != null)
        {
            $bill->status = 1;
            $bill->save();
            Session::flash('success', 'Bill Submitted Successfully');
            return redirect()->route('pages.dashboard');
        }
        else
        {
            Session::flash('errmsg', 'Add Bill Failed');
            return redirect()->route('pages.dashboard');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Find the bill in the database
        $bill = Bill::find($id);        
        $billinfo['bill'] = $bill;
        return view('bill.edit')->withBillinfo($billinfo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate Data
        $this->validate($request, array(
            'bill_id'      => 'required|numeric'
        ));


        $bill = Bill::find($request->bill_id);
        // Reset the status of bill to 0
        $bill->status = 0;
        $bill->save();
        return view('bill.edit2')->withBillinfo($bill);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
