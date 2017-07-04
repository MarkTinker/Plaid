<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bill;
use Auth;


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
        return view('bill.create2')->withBillid($bill->id);
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
        
        $bill->payment_option = 'Payment Option '.(intval($request->payment_option)+1);
        $bill->save();
        $billInfo['bill'] = $bill;
        return view('bill.create3')->withBillinfo($billInfo);
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
            'user_id'      => 'required|max:191',
            'billname'      => 'required|max:191',
            'duedate'       => 'required|date:after',
            'amount'        => 'required|numeric'
            
        ));

        $bill = Bill::find($request->bill_id);
        
        $bill->payment_option = 'Payment Option '.(intval($request->payment_option)+1);
        $bill->save();
        $billInfo['bill'] = $bill;
        return view('bill.create3')->withBillinfo($billInfo);
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
        //
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
        //
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
