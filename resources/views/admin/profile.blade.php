@extends('layouts.main')

@section('title', 'Admin - Profile')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Basic Tabs
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#Profile" data-toggle="tab">Profile</a>
                        </li>
                        <li><a href="#bankinfo" data-toggle="tab">Bank Account Info(Items)</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="Profile">
                            <h4>Profile</h4>
                            <div class="form-group">
                                <label class="control-label">Name</label>
                                <p class="form-control form-control-static">{{ $view_data['basic_data']->fname.' '.$view_data['basic_data']->lname }}</p>
                            </div>                                    
                            <div class="form-group">
                                <label class="control-label">Email</label>
                                <p class="form-control form-control-static">{{ $view_data['basic_data']->email }}</p> 
                            </div>
                            <div class="form-group">
                                <label class="control-label">Phone</label>
                                <p class="form-control form-control-static">{{ $view_data['basic_data']->phone }}</p>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Address</label>
                                <p class="form-control form-control-static">{{ $view_data['basic_data']->address1 }}</p>
                                <p class="form-control form-control-static">{{ $view_data['basic_data']->address2 }}</p>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="bankinfo">
                            <h4>Bank Account Info(Items)</h4>
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
                                    <?php
                                        foreach($view_data['items_data'] as $key=>$item)
                                        {
                                            echo '<tr onclick="itemdetail('."'".$item['account_id']."'".','."'".$item['access_token']."'".');" style="cursor: pointer;">';
                                                echo '<td>'.($key+1).'</td>';
                                                echo '<td>'.$item['account_name'].'</td>';
                                                echo '<td>'.$item['institution_name'].'</td>';
                                            echo '<tr>';
                                        }                                
                                        ?>
                                    </tbody>
                                </table>
                                <form role="form" method="POST" id="itemdetailform" action="{{ route('admin.itemdetail') }}">
                                    {{ csrf_field() }}
                                    <input type="hidden" id="account_id" name="account_id" value="">
                                    <input type="hidden" id="access_token" name="access_token" value="">
                                </form>
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
    function itemdetail(account_id, access_token)
    {
        $('#account_id').val(account_id);
        $('#access_token').val(access_token);
        $('#itemdetailform').submit();
    }
</script>
@endsection