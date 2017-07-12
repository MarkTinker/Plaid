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
                        <li class="active"><a href="#Profile" data-toggle="tab">Profile</a></li>
                        <li><a href="#bankinfo" data-toggle="tab">Bank Account Info(Items)</a></li>
                        <li><a href="#billinfo" data-toggle="tab">Bill Info</a></li>
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

                        <div class="tab-pane fade in active" id="billinfo">
                            <h4>Bill Info</h4>
                            <hr/>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Due Date</th>
                                            <th>Amount</th>
                                            <th>Payment Option</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($view_data['bill_data'] as $key=>$bill)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $bill->bill_name }}</td>
                                        <td>{{ $bill->due_date }}</td>
                                        <td>{{ $bill->amount }}</td>
                                        <td>{{ 'PaymentOption '. ($bill->payment_option + 1) }}</td>
                                        <td>
                                            <select name="status" class="billstatus form-control form-filter input-sm" value="" data-billid="{{ $bill->id }}">
                                                <option value="0" {{ $bill->status == 0? 'selected':'' }}> Not Submitted </option>
                                                <option value="1" {{ $bill->status == 1? 'selected':'' }}> In Review </option>
                                                <option value="2" {{ $bill->status == 2? 'selected':'' }}> Rejected </option>
                                                <option value="3" {{ $bill->status == 3? 'selected':'' }}> Information Requested </option>
                                                <option value="4" {{ $bill->status == 4? 'selected':'' }}> Paid </option>
                                            </select>
                                        </td>
                                        <td>
                                            <a href="{{ route('bill.show', $bill->id) }}"> Detail View</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
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

    jQuery(document).ready(function($) {
        $(".clickable-row").click(function() {
            window.location = $(this).data("href");
        });

        $('.billstatus').change( function() {
            $(this).find(":selected").each(function () {
                console.log( $(this).val() + $(this).parent().data('billid') );
                // Send Ajax Request to change the status of the bill
                var formData = {
                        id:$(this).parent().data('billid'),
                        value:$(this).val(),
                        "_token": "{{ csrf_token() }}",
                        };

                $.ajax({
                    url : "{{ route('admin.changestatus') }}",
                    type: "POST",
                    data : formData,
                    success: function(data, textStatus, jqXHR)
                    {
                        
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                
                    }
                });
            });
        });
        
     });

     
</script>
@endsection