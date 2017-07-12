@extends('layouts.main')

@section('title', 'Item Detail')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Basic Tabs
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#transaction" data-toggle="tab">Transaction</a></li>
                        <li><a href="#income" data-toggle="tab">Income</a></li>
                        <li><a href="#balance" data-toggle="tab">Balance</a></li>
                        <li><a href="#stripeach" data-toggle="tab">Stripe ACH</a></li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="transaction">
                            <h4>Transaction</h4>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Account_ID</th>
                                            <th>Amount</th>
                                            <th>Category</th>
                                            <th>Date</th>
                                            <th>Address</th>
                                            <th>City</th>
                                            <th>State</th>
                                            <th>Zip</th>
                                            <th>Name</th>
                                            <th>Pending</th>
                                            <th>Account_Owner</th>
                                            <th>Transaction_Id</th>
                                            <th>Transaction_Type</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    //echo (json_decode($view_data['transaction'], true));
                                    //print_r($view_data['transaction']);
                                    $transactions = $view_data['transaction']['transactions'];
                                    
                                    foreach($transactions as $key=>$transaction)
                                    {
                                        echo '<tr style="cursor: pointer;">';
                                            echo '<td>'.($key+1).'</td>';
                                            echo '<td>'.$transaction['account_id'].'</td>';
                                            echo '<td>'.$transaction['amount'].'</td>';
                                            echo '<td>';
                                                /*
                                                foreach($transaction['category'] as $category)
                                                {
                                                    echo $category.' ';
                                                }*/
                                                print_r($transaction['category']);
                                            echo '</td>';                                                    
                                            echo '<td>'.$transaction['date'].'</td>';
                                            echo '<td>'.$transaction['location']['address'].'</td>';
                                            echo '<td>'.$transaction['location']['city'].'</td>';
                                            echo '<td>'.$transaction['location']['state'].'</td>';
                                            echo '<td>'.$transaction['location']['zip'].'</td>';
                                            echo '<td>'.$transaction['name'].'</td>';
                                            echo '<td>'.$transaction['pending'].'</td>';
                                            echo '<td>'.$transaction['account_owner'].'</td>';
                                            echo '<td>'.$transaction['transaction_id'].'</td>';
                                            echo '<td>'.$transaction['transaction_type'].'</td>';
                                        echo '<tr>';
                                    }                    
                                    ?>
                                    </tbody>
                                </table>                                    
                            </div>
                        </div> 
                        <div class="tab-pane fade" id="income">
                            <h4>Income</h4>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Confidence</th>
                                            <th>Days</th>
                                            <th>Monthly_Income</th>
                                            <th>Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $income_streams = $view_data['income']['income']['income_streams'];
                                        foreach($income_streams as $key=>$income)
                                        {
                                            echo '<tr style="cursor: pointer;">';
                                                echo '<td>'.($key+1).'</td>';
                                                echo '<td>'.$income['confidence'].'</td>';
                                                echo '<td>'.$income['days'].'</td>';
                                                echo '<td>'.$income['monthly_income'].'</td>';
                                                echo '<td>'.$income['name'].'</td>';
                                            echo '<tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>

                                <?php
                                echo ('<h4>last_year_income:<small>'.$view_data['income']['income']['last_year_income'].'</small></h4>');
                                echo ('<h4>last_year_income_before_tax:<small>'.$view_data['income']['income']['last_year_income_before_tax'].'</small></h4>');
                                echo ('<h4>projected_yearly_income:<small>'.$view_data['income']['income']['projected_yearly_income'].'</small></h4>');
                                echo ('<h4>projected_yearly_income_before_tax:<small>'.$view_data['income']['income']['projected_yearly_income_before_tax'].'</small></h4>');
                                ?>
                            </div>
                        </div>  
                        <div class="tab-pane fade" id="balance">
                            <h4>Balance</h4>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Account_Id</th>
                                            <th>Balance_Available</th>
                                            <th>Balance_Current</th>
                                            <th>Balance_Limit</th>
                                            <th>Mask</th>
                                            <th>Name</th>
                                            <th>Official_name</th>
                                            <th>Subtype</th>
                                            <th>Type</th>                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $accounts = $view_data['balance']['accounts'];
                                        foreach($accounts as $key=>$account)
                                        {
                                            echo '<tr style="cursor: pointer;">';
                                                echo '<td>'.($key+1).'</td>';
                                                echo '<td>'.$account['account_id'].'</td>';
                                                echo '<td>'.$account['balances']['available'].'</td>';
                                                echo '<td>'.$account['balances']['current'].'</td>';
                                                echo '<td>'.$account['balances']['limit'].'</td>';
                                                echo '<td>'.$account['mask'].'</td>';
                                                echo '<td>'.$account['name'].'</td>';
                                                echo '<td>'.$account['official_name'].'</td>';
                                                echo '<td>'.$account['subtype'].'</td>';
                                                echo '<td>'.$account['type'].'</td>';
                                            echo '<tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>                                
                            </div>
                        </div>
                        <div class="tab-pane fade" id="stripeach">
                            <h4>Stripe ACH</h4>
                            <div class="table-responsive">
                                <div class="form-group">
                                    <label>Amount</label>
                                    <input class="form-control" id ="amount" placeholder="Enter Amount" value="0">
                                    <input type="hidden" id="stripebanktoken" value="{{$view_data['stripebanktoken']['stripe_bank_account_token']}}">
                                </div> 
                                <a onclick="createcharge()" class="btn btn-primary"> Pay</a>
                            </div>
                        </div>                           
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });

    function createcharge()
    {
        var amount = $('#amount').val();
        var type = "usd";
        var bankaccountoken = $('#stripebanktoken').val();
        var szUrl = '{{ route("stripe.ach") }}';

        $.ajax({
            type: "POST",
            url: szUrl,
            data: { amount: amount, type: type, bankaccountoken: bankaccountoken },
            datatype: 'json',
            success: function(data) {
                alert(data);
            }
        });
    }
</script>
@endsection