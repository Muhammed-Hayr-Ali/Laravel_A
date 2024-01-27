@extends('admin.layouts.master')
@section('title', trans('Home'))

@section('content-header')

    <li>
        <a href="{{ route('index') }}"
            class="text-neutral-500 transition duration-200 hover:text-neutral-600 hover:ease-in-out motion-reduce:transition-none dark:text-neutral-200">{{ __('Home') }}</a>
    </li>
@endsection
@section('Home', 'active')
@section('content')
    <!-- الاحصائيات -->
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3> {{ $data['newOrders'] }}</h3>

                    <p>{{ __('New Orders') }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <a href="#" class="small-box-footer">
                    {{ __('More info') }} <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $data['unreadMessages'] }}<sup style="font-size: 20px"></sup></h3>

                    <p>{{ __('Unread Messages') }}</p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-envelope"></i>
                </div>
                <a href="#" class="small-box-footer">
                    {{ __('More info') }} <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-warning ">
                <div class="inner">
                    <h3>{{ $data['userRegistrations'] }}</h3>

                    <p>{{ __('User Registrations') }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <a href="#" class="small-box-footer">
                    {{ __('More info') }} <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $data['visitors'] }}</h3>

                    <p>{{ __('Visitors') }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-chart-pie"></i>
                </div>
                <a href="#" class="small-box-footer flex items-center">
                    {{ __('More info') }} <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
    </div>
@endsection
