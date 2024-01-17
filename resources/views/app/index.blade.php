@extends('app.layouts.master')

@section('title', 'Home')
@section('css')
@endsection
@section('content')
    @include('app.components.navbar')
    @include('app.components.login')
    @include('app.components.registration')
<div class="mt-28">
    <h1>Home</h1>

</div>
@endsection
@section('script')
@endsection
