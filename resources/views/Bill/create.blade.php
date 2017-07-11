@extends('layouts.main')

@section('title', 'Bill Create')

@section('stylesheets')

<!-- Dropzone Custom CSS -->
<link rel="stylesheet" href="{{asset('css/dropzone.css') }}">

@endsection
@section('content')

<h1>Add Bill - Step1</h1>
<hr/>
<form role="form" method="POST" action="{{ route('bill.store') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="row bill-content">
        <div class="col-md-6 col-sm-12 col-xs-12 text-center">
            <div id="dropzone" class="dropzone"></div>

            <div class="table table-striped files" id="previews">
                <div id="template" class="file-row">
                    <!-- This is used as the file preview template -->
                    <div class="preview"><img data-dz-thumbnail />
                        <div class="preview-detail">                            
                            <div>
                                <button data-dz-remove class="btn delete">
                                    <i class="glyphicon glyphicon-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>                        
                </div>
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

<script type="text/javascript" src="{{ asset('js/dropzone.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>

<script>
    jQuery(document).ready(function() {    
        if (jQuery().datepicker) {
            $('.date-picker').datepicker({
                rtl: false,
                orientation: "left",
                autoclose: true
            });
        }

        //Dropzone.autoDiscover = false;

        // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
        var previewNode = document.querySelector("#template");
        previewNode.id = "";
        var previewTemplate = previewNode.parentNode.innerHTML;
        previewNode.parentNode.removeChild(previewNode);

        Dropzone.options.dropzone = {
            url: "{{ route('bill.store') }}",
            thumbnailWidth: 80,
            thumbnailHeight: 80,
            parallelUploads: 20,
            previewTemplate: previewTemplate,
            autoQueue: false, // Make sure the files aren't queued until manually added
            previewsContainer: "#previews", // Define the container to display the previews
            dictDefaultMessage : "Drop files here or click to upload",
            hiddenInputContainer : "#dropzone",            
            paramName:"billimg",
            uploadMultiple: true,
            autoProcessQueue: false,
            parallelUploads:100,
            maxFiles : 100,
        }

        /*
        // Init Dropzone
        var myDropzone = $("div#dropzone").dropzone({ 
            
            
        });
        Dropzone.options.dropzone = {
            
        }*/
    });
</script>

@endsection