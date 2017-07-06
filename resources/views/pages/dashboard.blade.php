@extends ('layouts.main')

@section ('title', 'Dashboard')

@section ('content')

    <div class="text-center">
        <a href="{{ route('bill.create') }}" class="btn btn-primary"> Add Bill <span class="glyphicon glyphicon-plus"></span></a>
    </div>
    

    <hr/>    
    @foreach($bills as $bill)
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
            <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="bill-detail">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="name">
                                <a href="">
                                    Bill Name
                                    <span> Due Date</span>
                                </a>                        
                            </h4>
                            <p class="price-container">
                                <span>$99</span>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <h2 class="tag2">Not Submitted</h2>
                        </div>
                    </div>                    
                </div>
                <div class="row">
                    <div class="description">
                        <p>Proin in ullamcorper lorem. Maecenas eu ipsum </p>
                    </div>
                    <div class="col-md-6 col-md-offset-3">
                        <div class="col-md-6 text-center">
                            <a class="btn btn-primary"> Edit </a>
                        </div>
                        <div class="col-md-6 text-center">
                            <a class="btn btn-danger"> Delete</a>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    @endforeach

@endsection