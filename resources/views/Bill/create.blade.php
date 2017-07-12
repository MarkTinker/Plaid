@extends('layouts.main')

@section('title', 'Bill Create')

@section('content')

<h1>Add Bill - Step1</h1>
<hr/>
<form role="form" method="POST" action="{{ route('bill.store') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="row bill-content">
        <div class="col-md-6 col-sm-12 col-xs-12 text-center">
            <div class="text-center">
                <a class="btn btn-primary" type="button" id="add_img"><span class="glyphicon glyphicon-plus"></span> Add</a>
            </div>
            <div id="billimages">
                
            </div>
        </div>
        <div class="col-md-6 col-sm-12 col-xs-12 text-left">
            <div class="bill-detail">
                <div class="row">
                    <div class="form-group">
                        <label class="control-label" for="billname">Bill Name</label>
                        <input type="text" class="form-control" id="billname" name="billname">
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="control-label" for="due_date">Due Date</label>
                                <div class="input-group">
                                    <span class="input-group-addon ">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>                                    
                                    <input class="form-control form-control-inline date-picker" size="16" type="text" name="duedate" value=""/>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label" for="amount"> Amount</label>
                                <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    <input type="text" class="form-control" id="amount" name="amount">
                                </div>                                
                            </div>
                        </div>
                    </div>                    
                </div>
                <hr/>
                <button id="submit" type="submit" class="btn btn-default">Submit</button>
            </div>
        </div>
    </div>
</form>
@endsection

@section ('scripts')

<script type="text/javascript" src="{{ asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>

<script>
    var img_id = 0;
    jQuery(document).ready(function() {    
        if (jQuery().datepicker) {
            $('.date-picker').datepicker({
                rtl: false,
                orientation: "left",
                autoclose: true
            });
        }

        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    input.parentElement.getElementsByTagName('img')[0].src = e.target.result;
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

         

        $('#add_img').click(function(e) {
            e.preventDefault();
            var tmpId = img_id;
            img_id++;
            var $div = '<div id="bill'+tmpId+'" class="billimage-container">' +
                '<div class="billimage-preview">' +
                        '<img src=""/>' +
                    '</div>' +
                    '<input name="file[]" type="file"/>' +
                    '<a class="btn btn-remove"><span class="glyphicon glyphicon-trash"></span></a>' +
                '</div>';
            
            $('#billimages').append($div);
            $("#bill"+ tmpId +" input").trigger('click');
            $("#bill"+ tmpId +" input").change(function(){
                readURL(this);
            });
            $("#bill"+ tmpId +" .btn-remove").click(function(e){
                $(this).closest('.billimage-container').remove();
            });

        });
    });
</script>

@endsection