<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;600;700;800&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="https://use.typekit.net/uid2kib.css">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        @livewireStyles
        @stack('styles')
    </head>
    <body class="font-sans antialiased" x-data="{ openMenu : false, menuOpened:false }" :class="openMenu ? 'overflow-hidden' : 'overflow-visiblee' ">
        <div class="min-h-screen bg-gray-100">
{{--            @include('layouts.navigation')--}}
                @include('partials.headers.header-v1')


            <!-- Page Content -->
            <main class="w-full">
                <div class="container no-padding my-4 sm:min-h-full">
                    <div class="grid grid-cols-1 sm:grid-cols-4">
                        <div class="hiddenn sm:block sidebar border-r bg-clip-padding h-full sm:rounded-l-3xl bg-white overflow-hidden ">
                            <ul class="menu flex overflow-x-auto gap-4 sm:gap-2 sm:flex-col">
                                <li class="hover-bordered hover:bg-gray-200 hover:border-l-2 hover:border-primary m-2 sm:m-0"><a href="{{ route('account.index') }}" class="flex whitespace-nowrap sm:whitespace-normal justify-between sm:p-4 sm:px-6 @if(request()->routeIs('account.index')) active text-white @endif">Home <svg class="w-4 h-4 hidden sm:block" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></a></li>
                                <li class="hover-bordered hover:bg-gray-200 hover:border-l-2 hover:border-primary m-2 sm:m-0"><a href="{{ route('account.order.index') }}" class="flex whitespace-nowrap sm:whitespace-normal justify-between sm:p-4 sm:px-6 @if(request()->routeIs('account.order.index')) active text-white @endif">Orders <svg class="w-4 h-4 hidden sm:block" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></a></li>
                                @if(!Auth::user()->verified)
                                <li class="hover-bordered hover:bg-gray-200 hover:border-l-2 hover:border-primary m-2 sm:m-0"><a href="{{ route('account.verification.index') }}" class="flex whitespace-nowrap sm:whitespace-normal justify-between px-4 rounded-xl sm:rounded-none border sm:border-none sm:p-4 sm:px-6 @if(request()->routeIs('account.verification.index')) active text-white @endif">Verification <svg class="w-4 h-4 hidden sm:block" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></a></li>
                                @endif
                                <li class="hover-bordered hover:bg-gray-200 hover:border-l-2 hover:border-primary m-2 sm:m-0"><a href="{{ route('account.password.index') }}" class="flex whitespace-nowrap sm:whitespace-normal justify-between sm:p-4 sm:px-6 @if(request()->routeIs('account.password.index')) active text-white @endif">Change Password <svg class="w-4 h-4 hidden sm:block" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></a></li>
{{--                                <li class="hover-bordered"><a href="{{ route('account.settings.index') }}" class="flex justify-between @if(request()->routeIs('account.settings.index')) active text-white @endif">Settings <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></a></li>--}}
                                <li class="hover-bordered hover:bg-gray-200 hover:border-l-2 hover:border-primary m-2 sm:m-0"><a class="flex whitespace-nowrap sm:whitespace-normal justify-between sm:p-4 sm:px-6">Logout <svg class="w-4 h-4 hidden sm:block" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></a></li>
                            </ul>
                        </div>
                        <div class="content col-span-3 p-4 min-h-full bg-white">
                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </main>
            @include('partials.footers.footer-v1')
        </div>

        <!-- Scripts -->
        @livewireScripts
        <script src="{{ asset('js/app.js') }}"></script>
        @stack('scripts')
    </body>
</html>
