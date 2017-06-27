@extends ('layouts.main')

@section('title', 'Login')

@section ('content')

<form role="form" method="POST" action="{{ route('login.createuser') }}">
    {{ csrf_field() }}
    <div class="form-group">
        <label class="control-label" for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{$info['name']}}">
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
        <label class="control-label" for="address">Address</label>
        <input type="text" class="form-control" id="address" name="address">
    </div>
    <input type="hidden" id="facebook_id" name="facebook_id" value ="{{$info['facebook_id']}}">
    <button type="submit" class="btn btn-default">Submit Button</button>
    <button type="reset" class="btn btn-default">Reset Button</button>
</form>

@endsection