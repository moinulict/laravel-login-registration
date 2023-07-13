@extends('layouts.auth')

@section('content')
    <form method="post" action="{{ route('login.check') }}">
        
        @csrf 

        <h1 class="h3 mb-3 fw-normal">Login</h1>

        @include('layouts.common.messages')

        <div class="form-group form-floating mb-3">
            <input type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" required="required" autofocus autocomplete="off">
            <label for="floatingName">Email</label>
            @if ($errors->has('email'))
                <span class="text-danger text-left">{{ $errors->first('email') }}</span>
            @endif
        </div>
        
        <div class="form-group form-floating mb-3">
            <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Password" required="required">
            <label for="floatingPassword">Password</label>
            @if ($errors->has('password'))
                <span class="text-danger text-left">{{ $errors->first('password') }}</span>
            @endif
        </div>

        <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
        <p class="mt-2"> Do not have an account? click <a href="{{ route('register.showForm') }}">here</a> to signup now. </p>
    </form>
@endsection