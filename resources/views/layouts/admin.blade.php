<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="apple-touch-icon" sizes="180x180" href="{{Storage::url('favicon/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{Storage::url('favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{Storage::url('favicon/favicon-16x16.png')}}">
    <link rel="manifest" href="{{Storage::url('favicon/site.webmanifest')}}">


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;600;700;800&display=swap" rel="stylesheet">

    <!-- Adobe Fonts -->
    <link rel="stylesheet" href="https://use.typekit.net/uid2kib.css">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @livewireStyles
    @stack('styles')
</head>
<body class="font-sans antialiased" x-data="{ sidebarOpened: false, scrollAtTop:false}"
      @scroll.window="window.pageYOffset > 40 ? scrollAtTop = true: scrollAtTop= false">

<div x-data="{ menuOpen: false }" class="flex min-h-screen custom-scrollbar">

    <!-- start::Black overlay -->
    <div :class="menuOpen ? 'block' : 'hidden'" @click="menuOpen = false" class="fixed z-20 inset-0 bg-black opacity-50 transition-opacity lg:hidden"></div>
    <!-- end::Black overlay -->

    @include('partials.admin.sidebar')

    <div class="lg:pl-64 w-full flex flex-col">
    @include('partials.admin.header')
    <!-- start:Page content -->
        <div class="h-full bg-slate-100 p-4">
            {{ $slot }}
        </div>
        <!-- end:Page content -->
        @include('partials.admin.footer')
    </div>


</div>


{{--@include('partials.loader')--}}

<!-- Scripts -->
@livewireScripts
{{--@stack('scripts')--}}
<script src="https://unpkg.com/@alpinejs/collapse@3.4.2/dist/cdn.min.js"></script>
<script src="{{ asset('js/app.js') }}"></script>

@livewireChartsScripts

@stack('scripts')
<script src="{{ asset('vendor/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>

<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        showCloseButton: true,
        timer: 5000,
        timerProgressBar:true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    window.addEventListener('alert',({detail:{type,message}})=>{
        Toast.fire({
            icon:type,
            title:message
        })
    })

    @if(session('success'))
    Toast.fire({
        icon:'success',
        title:'{{session("success")}}'
    })
    @endif

    @if($errors->any())
    @foreach ($errors->all() as $error)
    Toast.fire({
        icon:'error',
        title:'{{$error}}'
    })
    @endforeach
    @endif
</script>

</body>
</html>
