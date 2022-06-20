<div>
    <!-- start::Weekly Sales Chart -->
    <x-card class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 2xl:col-span-2 mb-4">
        <div class="flex items-center justify-between mb-4">
            <div class="flex-shrink-0">
                <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">{{ app_money_format($weekSales) }}</span>
                <h3 class="text-base font-normal text-gray-500">Sales this week</h3>
            </div>
            <div class="flex items-center justify-end flex-1 text-base font-bold @if($salesPercentChange>0) text-green-500 @elseif($salesPercentChange<0) text-red-500 @else text-blue-500 @endif">
                {{$salesPercentChange}}%
                @if($salesPercentChange>0)
                    <x-cui-cil-arrow-top class="w-5 h-5" />
                @elseif($salesPercentChange<0)
                    <x-cui-cil-arrow-bottom class="w-5 h-5" />
                @endif
            </div>
        </div>

        <div id="{!! $chartId !!}"></div>
    </x-card>
    <!-- start::eekly Sales Chart -->

    <!-- start::Stats -->
    <div class="mt-4 w-full grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
        <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">{{$productsCount}}</span>
                    <h3 class="text-base font-normal text-gray-500">Total products</h3>
                </div>
                <div class="ml-5 w-0 flex items-center justify-end flex-1 text-green-500 text-base font-bold">
                    <svg class="w-12 2xl:w-16 h-12 2xl:h-16 p-1 2xl:p-3 bg-green-400 bg-opacity-20 rounded-full text-green-600 border border-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                </div>
            </div>
        </div>
        <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">{{$totalOrders}}</span>
                    <h3 class="text-base font-normal text-gray-500">Total Orders</h3>
                </div>
                <div class="ml-5 w-0 flex items-center justify-end flex-1 text-green-500 text-base font-bold">
{{--                    <svg class="w-12 2xl:w-16 h-12 2xl:h-16 p-1 2xl:p-3 bg-indigo-400 bg-opacity-20 rounded-full text-indigo-600 border border-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>--}}
                    <x-cui-cil-clipboard class="w-12 2xl:w-16 h-12 2xl:h-16 p-1 2xl:p-3 bg-indigo-400 bg-opacity-20 rounded-full text-indigo-600 border border-indigo-600" />
                </div>
            </div>
        </div>
        <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">{{$userCount}}</span>
                    <h3 class="text-base font-normal text-gray-500">User signups</h3>
                </div>
                <div class="ml-5 w-0 flex items-center justify-end flex-1 text-red-500 text-base font-bold">
                    <svg class="w-12 2xl:w-16 h-12 2xl:h-16 p-1 2xl:p-3 bg-blue-400 bg-opacity-20 rounded-full text-blue-600 border border-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                </div>
            </div>
        </div>
    </div>
    <!-- end::Stats -->

    <div class="mt-4 w-full">
        <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
            <div class="mb-4 flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Latest Orders</h3>
                    <span class="text-base font-normal text-gray-500">This is a list of latest orders</span>
                </div>
                <div class="flex-shrink-0">
                    <a href="{{route('admin.orders.index')}}" class="text-sm font-medium text-cyan-600 hover:bg-gray-100 rounded-lg p-2">View all</a>
                </div>
            </div>
            <div class="flex flex-col mt-8">
                <div class="overflow-x-auto rounded-lg">
                    <div class="align-middle inline-block min-w-full">
                        <div class="shadow overflow-hidden sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Order
                                        </th>
                                        <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Customer
                                        </th>
                                        <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Amount
                                        </th>
                                        <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Date
                                        </th>
                                        <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Payment Status
                                        </th>
                                        <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status
                                        </th>
                                        <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                @forelse($recentOrders as $order)
                                    <tr class="@if($loop->even) bg-gray-50 @endif">
                                        <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                            #{{$order->order_number}}
                                        </td>
                                        <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">
                                            <span class="font-semibold">{{$order->user->name}}</span>
                                        </td>
                                        <td class="p-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                            {{$order->grand_total}}
                                        </td>
                                        <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                            {{ $order->created_at->format('F j, Y') }}
                                        </td>
                                        <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                            @if($order->payment_status === \App\Enums\PaymentStatus::PENDING)
                                                <span class="bg-warning px-1.5 py-0.5 rounded-lg text-gray-100">
                                                Pending
                                                </span>
                                            @elseif($order->payment_status === \App\Enums\PaymentStatus::CANCELED)
                                                <span class="bg-red-500 px-1.5 py-0.5 rounded-lg text-gray-100">
                                                Canceled
                                                </span>
                                            @elseif($order->payment_status === \App\Enums\PaymentStatus::PAID)
                                                <span class="bg-green-500 px-1.5 py-0.5 rounded-lg text-gray-100">
                                                    Paid
                                                </span>
                                            @else
                                                <span class="bg-red-500 px-1.5 py-0.5 rounded-lg text-gray-100">
                                                Expired
                                                </span>
                                            @endif
                                        </td>
                                        <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                            @if($order->status == 'completed' || $order->status == 'delivered')
                                                <span class="bg-green-500 px-1.5 py-0.5 rounded-lg text-gray-100">
                                                    {{ $order->status }}
                                                </span>
                                            @else
                                                <span class="bg-secondary px-1.5 py-0.5 rounded-lg text-gray-100">
                                                    {{ $order->status }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                            <a href="{{ route('admin.orders.edit', $order->id) }}" class="bg-primary hover:bg-opacity-90 px-2 py-1 mr-2 text-gray-100 rounded-lg">View Details</a>
                                        </td>
                                    </tr>
                                @empty
                                @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <div class="w-full grid grid-cols-1 sm:grid-cols-2 2xl:grid-cols-3 gap-4">
            <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8  2xl:col-span-2">
                <div class="mb-4 flex items-center justify-between">
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Verification Requests</h3>
                        <span class="text-base font-normal text-gray-500">This is a list of latest verification requests</span>
                    </div>
                    <div class="flex-shrink-0">
                        <a href="{{route('admin.users.verifications.index')}}" class="text-sm font-medium text-cyan-600 hover:bg-gray-100 rounded-lg p-2">View all</a>
                    </div>
                </div>
                <div class="flex flex-col mt-8">
                    <div class="overflow-x-auto rounded-lg">
                        <div class="align-middle inline-block min-w-full">
                            <div class="shadow overflow-hidden sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            User
                                        </th>
                                        <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Date
                                        </th>
                                        <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Action
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white">
                                    @forelse($verificationRequests as $v)
                                        <tr class="@if($loop->even) bg-gray-50 @endif">
                                            <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">
                                                <span class="font-semibold">{{$v->last_name.' '.$v->last_name}}</span>
                                                <p class="text-xs">{{$v->email}}</p>
                                            </td>
                                            <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                                <span class="badge badge-danger badge-sm">{{$v->status}}</span>
                                            </td>
                                            <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                                {{ $v->created_at->format('F j, Y') }}
                                            </td>
                                            <td class="p-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                                <a href="{{ route('admin.users.verifications.show', $v->id) }}" class="btn-primary btn btn-sm">Edit</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4">No data</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
                <div class="mb-4 flex items-center justify-between">
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Latest Users</h3>
                        <span class="text-base font-normal text-gray-500">This is a list of latest users</span>
                    </div>
                    <div class="flex-shrink-0">
                        <a href="{{route('admin.users.index')}}" class="text-sm font-medium text-cyan-600 hover:bg-gray-100 rounded-lg p-2">View all</a>
                    </div>
                </div>
                <div class="flex flex-col mt-8">
                    <div class="overflow-x-auto rounded-lg">
                        <div class="align-middle inline-block min-w-full">
                            <div class="shadow overflow-hidden sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Name
                                        </th>
                                        <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Date
                                        </th>
                                        <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Action
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white">
                                    @forelse($recentUsers as $u)
                                        <tr class="@if($loop->even) bg-gray-50 @endif">
                                            <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">
                                                <span class="font-semibold">{{$u->name}}</span>
                                                <p class="text-xs">{{$u->email}}</p>
                                            </td>
                                            <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                                {{ $u->created_at->format('F j, Y') }}
                                            </td>
                                            <td class="p-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                                <a href="{{ route('admin.users.edit', $u->id) }}" class="btn-primary btn btn-sm">Edit</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4">No data</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
@prepend('scripts')
    {{-- Push ApexCharts to the top of the scripts stack --}}
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
@endprepend
@push('scripts')
    <script>
        (function () {

            const options = {
                series: [{
                    name: "Sales",
                    data: {!! json_encode($chartAmounts) !!}
                }],
                chart: {
                    id: `{!! $chartId !!}`,
                    type: 'area',
                    height: 350,
                    zoom: {
                        enabled: false
                    }
                },
                dataLabels: {
                    enabled: false
                },
                yaxis: {
                    opposite: true
                },
                labels: {!! json_encode($cartDates) !!},
                legend: {
                    horizontalAlign: 'right'
                }
            };


            const chart = new ApexCharts(document.getElementById(`{!! $chartId !!}`), options);
            chart.render();
            document.addEventListener('livewire:load', () => {
            @this.on(`refreshChartData-{!! $chartId !!}`, (chartData) => {
                chart.updateOptions({
                    xaxis: {
                        categories: chartData.salesData.labels
                    }
                });
                chart.updateSeries([{
                    data: chartData.salesData.dataset,
                    name: 'Sales',
                }]);
            });
            });
        }());
    </script>
@endpush
