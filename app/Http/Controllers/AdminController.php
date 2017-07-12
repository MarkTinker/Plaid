<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Bankaccount;
use App\Bill;
use App\BillImage;
class AdminController extends Controller
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

    public function index()
    {
        return view('admin.index')->withUsers(User::All());
    }

    public function getProfile($id)
    {
        // Get Basic Profile Info
        $profile = User::find($id);

        // Get Bank Accounts
        $bankaccounts = Bankaccount::where('user_id', $id)->get();

        // Get Bill Infos
        $bills = Bill::where('user_id', $id)->get();

        $view_data['basic_data'] = $profile;
        $view_data['items_data'] = $bankaccounts;
        $view_data['bill_data'] = $bills;

        return view('admin.profile')->with(array('view_data' => $view_data));
    }

    public function postItemDetail(Request $request)
    {
        $access_token = $request->access_token;
        $account_id = $request->account_id;
        
        // Get Transaction Data
        $url = 'https://sandbox.plaid.com/transactions/get';
        $postfields = json_encode(array('client_id'=>env('PLAID_CLIENT_ID'),'secret'=>env('PLAID_SECRET'), 'access_token'=>$access_token, 'start_date'=>'2017-01-01','end_date'=>'2017-02-01'));
        $response = $this->getUrlContent($url, $postfields);
        $transaction = json_decode($response, true);
        $view_data['transaction'] = $transaction;

        // Get Income Data
        $url = 'https://sandbox.plaid.com/income/get';
        $postfields = json_encode(array('client_id'=>env('PLAID_CLIENT_ID'),'secret'=>env('PLAID_SECRET'), 'access_token'=>$access_token));
        $response = $this->getUrlContent($url, $postfields);
        $income = json_decode($response, true);
        $view_data['income'] = $income;

        // Get Balance Data
        $url = 'https://sandbox.plaid.com/accounts/balance/get';
        $postfields = json_encode(array('client_id'=>env('PLAID_CLIENT_ID'),'secret'=>env('PLAID_SECRET'), 'access_token'=>$access_token));
        $response = $this->getUrlContent($url, $postfields);
        $balance = json_decode($response, true);
        $view_data['balance'] = $balance;

        // Create Bank Account Token
        $url = 'https://sandbox.plaid.com/processor/stripe/bank_account_token/create';
        $postfields = json_encode(array('client_id'=>env('PLAID_CLIENT_ID'),'secret'=>env('PLAID_SECRET'), 'access_token'=>$access_token,'account_id'=>$account_id));
        $response = $this->getUrlContent($url, $postfields);
        $stripebanktoken = json_decode($response, true);
        $view_data['stripebanktoken'] = $stripebanktoken;


        return view('admin.itemdetail')->with(array('view_data'=>$view_data));
    }

    /**
     * ACH in Stripe
     */
    public function postAch(Request $request)
    {
        
        $amount = $request->amount;
        $type = $request->type;
        $bankaccountoken = $request->bankaccountoken;
        
        \Stripe\Stripe::setApiKey("sk_test_kTP5Jqwf2qzVJDSkMcHLjdK1");
       
        $customer = \Stripe\Customer::create(array(
          "source" => $bankaccountoken,
          "description" => "Example customer"
        ));
        \Stripe\Charge::create(array(
          "amount" => 500,
          "currency" => "usd",
          "customer" => $customer,
        ));

        Session::flash('success', 'Created Charge');
        return redirect()->route('admin.index');
    }

    /**
        * This function receive ajax request and change the status 
    */
    public function ajaxChangeStatus(Request $request)
    {
        $id = $request->id;
        $value = $request->value;

        $bill = Bill::find($id);
        $bill->status = $value;
        $bill->save();
        return 'Success';
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
