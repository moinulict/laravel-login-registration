@extends('layouts.app')

@section('content')
    <div class="bg-light p-5 rounded">
        @auth
        <h1>Dashboard</h1>
        <p class="lead">Only authenticated users can access this section.</p>
        @auth
        {{auth()->user()->email}}
        <div>
          <a href="{{ route('logout') }}" class="btn btn-outline-dark me-2 mt-2">Logout</a>
        </div>
      @endauth
        @endauth

        @guest
        <h1>Homepage</h1>
        <p class="lead">Your viewing the home page. Please login <a href="{{ route('login.showForm') }}">here</a> to view the restricted data.</p>
        @endguest
    </div>
@endsection