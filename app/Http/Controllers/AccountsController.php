<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bankaccount;
use Auth;
use Session;
class AccountsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usrid = Auth::id();

        $bankaccounts = Bankaccount::where('user_id', $usrid)->get();
        if(Session::has('firstlogin')){
            Session::flash('CanSkip', 1);
        }
        return view('accounts.index')->withAccounts($bankaccounts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Get Account_id and public_token
        $metadata = json_decode($request->metadata);
        $account_id = $metadata->account_id;
        $public_token = $metadata->public_token;

        // Exchange Public Token to Access Token
        $url = 'https://sandbox.plaid.com/item/public_token/exchange';
        $postfields = json_encode(array('client_id'=>env('PLAID_CLIENT_ID'),'secret'=>env('PLAID_SECRET'), 'public_token'=>$public_token));
        $response = $this->getUrlContent($url, $postfields);        
        $response = json_decode($response);

        // Get Access Token from response
        $access_token = $response->access_token;

        $bankaccount = Bankaccount::where('user_id', Auth::id)
                        ->where('account_id', $account_id)->first();
        
        if($bankaccount == null)
        {
            $bankaccount = new Bankaccount();
        }
        else
        {
            // Updated Item
        }

        $bankaccount->user_id = Auth::id();
        $bankaccount->institution_id = $metadata->institution->institution_id;
        $bankaccount->institution_name = $metadata->institution->name;
        $bankaccount->account_id = $metadata->account_id;
        $bankaccount->account_name = $metadata->account->name;
        $bankaccount->access_token = $access_token;
        $bankaccount->save();

        Session::flash('success','Bank Account Added Successfully');
        return redirect()->route('accounts.index');
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

    /**
        * This function send post to $url and return response.
        *
        * @access   private
        * @param    string      $url                end point of request
        * @param    json string $fields             data which is sent with request
        * @return   string      $response           response data of request    
    */
    public function getUrlContent($url, $postfields)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);      
        $response = curl_exec($ch);
        curl_close ($ch);
        return $response;
    }
}
