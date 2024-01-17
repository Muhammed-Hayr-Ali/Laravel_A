@extends('admin.layouts.master')
@section('title', trans('Others'))
@section('content-header')
   
    <li>
        <span class="mx-2 text-neutral-500 dark:text-neutral-200">{{ __('Orders') }}</span>
    </li>
    <li>
        <span class="mx-2 text-neutral-500 dark:text-neutral-200">/</span>
    </li>
    <li>
        <a href="{{ route('others') }}"
            class="text-neutral-500 transition duration-200 hover:text-neutral-600 hover:ease-in-out motion-reduce:transition-none dark:text-neutral-200">{{ __('Others') }}</a>
    </li>
@endsection
@section('Orders', 'active')
@section('Others', 'active')
@section('content')


    @if (@isset($others) and !@empty($others))
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="py-3 px-6">Person</th>
                    <th scope="col" class="py-3 px-6">Bank Account</th>
                    <th scope="col" class="py-3 px-6">Amount</th>
                    <th scope="col" class="py-3 px-6">Approved</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($others as $other)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="py-4 px-6">Alex Johnson</td>
                        <td class="py-4 px-6">82926417</td>
                        <td class="py-4 px-6">$4,500.00</td>
                        <td class="py-4 px-6">Yes</td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    @else
        <div class="w-full  bg-white flex justify-center items-center"><img
                src="{{ asset('assets/admin/dist/img/no_orders.jpg') }}" alt=""></div>
    @endif






@endsection
