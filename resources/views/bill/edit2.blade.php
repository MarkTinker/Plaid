@extends('layouts.main')

@section('title','Create Bill - Step2')

@section('content')

<h1>Edit Bill - Step2</h1>
<hr/>
<form role="form" method="POST" action="{{ route('bill.store_paymentoption')}}">
{{ csrf_field() }}
<input type="hidden" id="bill_id" name="bill_id" value="{{ $billinfo->id }}">
<input type="hidden" id="payment_option" name="payment_option" value="{{ $billinfo->payment_option}} ">
<div class="row">
    <div class="col-md-4 paymentoption-container">
        <a data-id="0">
            <div class="paymentoption">
            <h1>Payment Option1</h1>
            <span class="tag glyphicon glyphicon-ok" @if($billinfo['payment_option'] != 0) style="display:none" @endif> </span>
        </div>
        </a>        
    </div>
    <div class="col-md-4 paymentoption-container">
        <a data-id="1">
            <div class="paymentoption">
                <h1>Payment Option2</h1>                
                <span class="tag glyphicon glyphicon-ok" @if($billinfo['payment_option'] != 1) style="display:none" @endif> </span>
            </div>
        </a>        
    </div>
    <div class="col-md-4 paymentoption-container">
        <a  data-id="2">
            <div class="paymentoption">
                <h1>Payment Option3</h1>
                <span class="tag glyphicon glyphicon-ok" @if($billinfo['payment_option'] != 2) style="display:none" @endif> </span>
            </div>
        </a>        
    </div>
</div>
<hr/>
<button type="submit" class="btn btn-default">Submit</button>
</form>

@endsection

@section ('scripts')

<script>    
    $('.paymentoption-container > a').click(function(){
        var option = $(this).data('id');
        $('#payment_option').val(option);
        $('.paymentoption-container span.tag').hide();
        $(this).find('span.tag').show();

    });
</script>
@endsection