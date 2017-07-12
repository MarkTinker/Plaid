@extends('layouts.main')

@section('title', 'Admin - Choose an Account')

@section('content')
<div class="container">
    <div class="row">
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
                                    <th>E-Mail Address</th>
                                    <th>Phone Number                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $key=>$user)
                                <tr data-href="{{ route('admin.profile', $user['id']) }}" class="clickable-row">
                                    <td> {{ $key+1 }} </td>
                                    <td> {{ $user->fname }} {{ $user->lname }}</td>
                                    <td> {{ $user->email }}</td>
                                    <td> {{ $user->phone }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section ('scripts')

<script>
    jQuery(document).ready(function($) {
        $(".clickable-row").click(function() {
            window.location = $(this).data("href");
    });
});
</script>
@endsection