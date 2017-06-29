@extends ('layouts.main')

@section ('title', 'Bank Accounts')

@section ('content')

<h1 class="text-center">
    Bank Accounts
</h1>
<hr/>
<div class="text-center">
    <a href="{{ route('account.create') }}" class="btn btn-primary"> Add Account</a>
</div>

<div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default">
        <div class="panel-heading">Accounts</div>
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
                    
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection