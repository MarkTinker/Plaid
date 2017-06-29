@extends('layouts.main')

@section('title','Create Bill - Step2')

@section('content')

<h1>Add Bill - Step2</h1>
<hr/>
<form role="form" method="POST" action="{{ route('bill.store2')}}">
{{ csrf_field() }}
<div class="row">
    <div class="col-md-4 paymentoption-container">
        <a>
            <div class="paymentoption">
            <h1>Payment Option1</h1>
        </div>        
        </a>        
    </div>
    <div class="col-md-4 paymentoption-container">
        <a>
            <div class="paymentoption">
                <h1>Payment Option2</h1>                
                <span class="tag glyphicon glyphicon-ok"> </span>
            </div>        
        </a>        
    </div>
    <div class="col-md-4 paymentoption-container">
        <a>
            <div class="paymentoption">
            <h1>Payment Option3</h1>
        </div>        
        </a>        
    </div>
</div>
</form>

@endsection