@extends('layouts.main')

@section('title','Create Bill - Summary')

@section('content')
<h1> Confirm Your Bill</h1>
<hr/>
<form role="form" class="form-horizontal" method="POST" action="{{ route('bill.submit_bill') }}">
{{ csrf_field() }}
<input type="hidden" name="bill_id" value="{{ $billinfo['bill']->id }}">
<div class="row bill-content">
        <div class="col-md-6 col-sm-12 col-xs-12 text-center">
            <div class="bill-image">            
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="item active">
                            <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="First slide">                                                            
                        </div>
                        <div class="item">
                            <img src="data:image/gif;base64,R0lGODlhAQABAIAAAGZmZgAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Second slide">                            
                        </div>
                        <div class="item">
                            <img src="data:image/gif;base64,R0lGODlhAQABAIAAAFVVVQAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Third slide">                            
                        </div>
                    </div>
                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
                    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
                </div><!-- /.carousel -->                       
            </div>            
        </div>
        <div class="col-md-6 col-sm-12 col-xs-12 text-left">
            <div class="bill-detail">
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
        </div>
    </div>
    <hr/>
    <div class="text-center">
        <button type="submit" class="btn btn-default btn-success">Submit</button>
    </div>    
</form>
@endsection