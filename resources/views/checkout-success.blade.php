<x-app-layout>
    <x-slot name="title">Order Success</x-slot>

    <div class="min-h-screen flex justify-center items-center align-middle text-center">
        <div class="text-center inline-block">
{{--            <x-cui-cil-check-circle class="inline-block text-success text-center w-40 h-40" size="64" />--}}

            <svg class="text-success text-center inline-block w-40 h-40" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>

            <div class="text-center">
                <h2 class="font-bold mb-10 text-2xl">
                    Order completed <a class="underline" href="{{ route('account.order.show', $order->order_number) }}">#{{$order->order_number}}</a>
                </h2>

                <a href="{{route('index')}}" class="underline">
                Back to home
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
