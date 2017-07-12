@extends ('layouts.main')

@section ('title', 'Login')

@section ('content')

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <form role="form" method="POST" action="{{ route('profile.store') }}">
            {{ csrf_field() }}
            <div class="row">
                <div class="form-group col-md-6">
                    <label class="control-label" for="fname">First name</label>
                    <input type="text" class="form-control" id="fname" name="fname" value="{{$info['fname']}}">
                </div>

                <div class="form-group col-md-6">
                    <label class="control-label" for="lname">Last name</label>
                    <input type="text" class="form-control" id="lname" name="lname" value="{{$info['lname']}}">
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label" for="email">Email</label>
                <input type="text" class="form-control" id="email" name="email" value="{{$info['email']}}">
            </div>

            <div class="form-group">
                <label class="control-label" for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone">
            </div>

            <div class="form-group">
                <label class="control-label" for="address1">Address</label>
                <input type="text" class="form-control" id="address1" name="address1">
                <input type="text" class="form-control" id="address2" name="address2">
            </div>

            <div class="form-group">
                <label class="control-label" for="city">City/State/Zip</label>
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" class="form-control " id="city" name="city">
                    </div>
                    
                    <div class="col-md-4">
                        <input type="text" class="form-control col-md-4" id="state" name="state">
                    </div>
                    
                    <div class="col-md-4">
                        <input type="text" class="form-control col-md-4" id="zip" name="zip">
                    </div>
                </div>        
            </div>
            <input type="hidden" id="facebook_id" name="facebook_id" value ="{{$info['facebook_id']}}">
            <button type="submit" class="btn btn-default">Submit Button</button>
        </form>
    </div>
</div>
@endsection