@extends ('layouts.main')

@section ('title', 'Bank Accounts')

@section ('content')

<h1 class="text-center">
    Bank Accounts
</h1>
<hr/>
<div class="text-center">
    <form id="plaidForm" method="POST" action="{{ route('account.store') }}">
        <input type="hidden" name="metadata" id="metadata" val=""/>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <a id="plaidLink" class="btn btn-primary"> <span class="glyphicon glyphicon-plus"></span> Add Account</a>
        
    </form>            
</div>
<br/>
@if(count($accounts)>0)
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Bank Accounts</div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Institution</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($accounts as $key=>$account)
                        <tr>
                            <td>{{ ($key+1) }}</td>
                            <td>{{ $account->account_name }}</td>
                            <td>{{ $account->institution_name }}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@if(Session::has('CanSkip'))
<div class="row">
    <div class="col-md-3 col-md-offset-9">
        <a href="{{ route('pages.dashboard') }}" >Skip for now</a>
    </div>
</div>
@else
    <div class="col-md-3 col-md-offset-9">
        <a href="{{ route('pages.dashboard') }}" >Continue</a>
    </div>
@endif
@endsection

@section('scripts')
    <script src="https://cdn.plaid.com/link/v2/stable/link-initialize.js"></script>
    <script>
        var linkHandler = Plaid.create({
        clientName: 'Stripe / Plaid Test',
        env: 'sandbox',
        key: 'ba2960f03013090db974d5d128257b', // Replace with your public_key to test with live credentials
        product: ['auth', 'transactions', 'identity', 'income'],
        apiVersion:'v2',
        selectAccount: true, // Optional – trigger the Select Account
        onLoad: function() {
            // Optional, called when Link loads
        },
        onSuccess: function(public_token, metadata) {
            document.getElementById('metadata').value = JSON.stringify(metadata);
            document.getElementById('plaidForm').submit();
        },
        onExit: function(err, metadata) {
            // The user exited the Link flow.
            if (err != null) {
            // The user encountered a Plaid API error prior to exiting.
            }
            // metadata contains information about the institution
            // that the user selected and the most recent API request IDs.
            // Storing this information can be helpful for support.
        }
        });
        $(document).ready(function() {
            $('#plaidLink').on('click', function(){
                linkHandler.open();
            });
        });
    </script>
@endsection