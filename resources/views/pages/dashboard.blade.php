@extends ('layouts.main')

@section ('title', 'Dashboard')

@section ('content')

    <div class="text-center">
        <a href="{{ route('bill.create') }}" class="btn btn-primary"> Add Bill <span class="glyphicon glyphicon-plus"></span></a>
    </div>
    

    <hr/>

    @foreach($billsinfo['bills'] as $key => $bill)
        <div class="row bill-content">
            <div class="col-md-6 col-sm-12 col-xs-12 text-center">
                <div class="bill-image">
                    <div id="myCarousel{{ $key }}" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            @foreach($billsinfo['billimgs'][$key] as $key1=>$billimg)                            
                                <li data-target="#myCarousel{{ $key }}" data-slide-to="{{$key1}}" class="{{$key1==0?'active':''}}"></li>
                            @endforeach                            
                        </ol>
                        <div class="carousel-inner">
                            @foreach($billsinfo['billimgs'][$key] as $key1=>$billimg)                            
                                <div class="item {{ $key1==0?'active':''}}">
                                    <img src="{{asset($billimg->filename)}}">
                                </div>
                            @endforeach                            
                        </div>
                        <a class="left carousel-control" href="#myCarousel{{ $key }}" role="button" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
                        <a class="right carousel-control" href="#myCarousel{{ $key }}" role="button" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
                    </div><!-- /.carousel -->
                </div>                
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="bill-detail">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="name">
                                <a href="">
                                    {{ $bill->bill_name }}
                                    <span> {{ $bill->due_date}}</span>
                                </a>                        
                            </h4>
                            <p class="price-container">
                                <span>${{ $bill->amount }}</span>
                            </p>
                        </div>
                        <div class="col-md-6">                            
                            @if($bill->status == 0)
                                <h2 class="tag2 text-info">
                                    Not Submitted
                                </h2>
                            @elseif ($bill->status == 1)
                                <h2 class="tag2 text-success">
                                    In Review
                                </h2>
                            @elseif ($bill->status == 2)
                                <h2 class="tag2 text-danger">
                                    Rejected
                                </h2>
                            @elseif ($bill->status == 3)
                                <h2 class="tag2 text-danger">
                                    Information Requested
                                </h2>
                            @elseif ($bill->status == 4)
                                <h2 class="tag2 text-primary">
                                    Paid
                                </h2>
                            @endif
                            
                        </div>
                    </div>                    
                </div>
                <div class="row">
                    <div class="description">
                        <p>Proin in ullamcorper lorem. Maecenas eu ipsum </p>
                    </div>
                    <div class="col-md-6 col-md-offset-3">
                        <div class="col-md-6 text-center">
                            <a href="{{ route('bill.edit', $bill->id) }}" class="btn btn-primary"> Edit </a>
                        </div>
                        <div class="col-md-6 text-center">
                            <form method="post" action ="{{ route('bill.destroy', $bill->id) }}" >
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <input class="btn btn-danger" type="submit" value="Delete">
                            </form>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
        <hr/>
    @endforeach

@endsection