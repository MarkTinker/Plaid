@extends('layouts.main')

@section('title', 'Bill - Show')

@section('content')
<div class="row bill-content">
    <div class="col-md-6 col-sm-12 col-xs-12 text-center">
        <div class="bill-image">            
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    @for($i = 1; $i < count($billinfo['billimage']); $i++)
                        <li data-target="#myCarousel" data-slide-to="{{ $i }}"></li>
                    @endfor
                </ol>
                <div class="carousel-inner">
                    @foreach($billinfo['billimage'] as $key => $billimg)
                    <div class="item {{ $key == 0 ? 'active' : ''}}">
                        <img src="{{ asset($billimg->filename) }}">
                    </div>
                    @endforeach
                </div>
                <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
                <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
            </div><!-- /.carousel -->                       
        </div>            
    </div>
    <div class="col-md-6 col-sm-12 col-xs-12 text-left">
        <div class="row bill-detail">
            <div class="form-group">
                <label class="control-label col-md-4 text-right">Bill Name:</label>
                <div class="col-md-7 col-md-offset-1">
                    <p class="form-control-static" data-display="billname">{{ $billinfo['bill']->bill_name }}</p>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4 text-right">Due Date:</label>
                <div class="col-md-7 col-md-offset-1">
                    <p class="form-control-static" data-display="duedate">{{ $billinfo['bill']->due_date }}</p>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4 text-right">Amount:</label>
                <div class="col-md-7 col-md-offset-1">
                    <p class="form-control-static" data-display="amount">${{ $billinfo['bill']->amount }}</p>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4 text-right">Payment Option:</label>
                <div class="col-md-7 col-md-offset-1">
                    <p class="form-control-static" data-display="duedate">Payment Option {{ $billinfo['bill']->payment_option + 1 }}</p>
                </div>
            </div>                
        </div> 
        <div class="row text-center">
            @if($billinfo['bill']->status == 0)
                <h2 class="tag2 text-info">
                    Not Submitted
                </h2>
            @elseif ($billinfo['bill']->status == 1)
                <h2 class="tag2 text-success">
                    In Review
                </h2>
            @elseif ($billinfo['bill']->status == 2)
                <h2 class="tag2 text-danger">
                    Rejected
                </h2>
            @elseif ($billinfo['bill']->status == 3)
                <h2 class="tag2 text-danger">
                    Information Requested
                </h2>
            @elseif ($billinfo['bill']->status == 4)
                <h2 class="tag2 text-primary">
                    Paid
                </h2>
            @endif
        </div>                
    </div>       
</div>
@endsection
