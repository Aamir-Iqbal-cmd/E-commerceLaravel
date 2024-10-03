
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="alert alert-success">
        <h1>Transaction Successful!</h1>
        <p>Your payment was successful. Thank you for your purchase.</p>
        <a href="{{ url('/') }}" class="btn btn-primary">Return to Home</a>
    </div>
</div>
@endsection
