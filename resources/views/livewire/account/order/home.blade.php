
    <!-- start::Table -->
    <div class="w-full bg-white rounded-lg px-0 sm:px-8 py-6 relative">
        <h4 class="text-xl font-semibold">Orders</h4>
        <div class="relative overflow-x-scroll">
            <table class="w-full my-8 whitespace-nowrap overflow-x-scroll custom-scrollbar">
                <thead class="bg-primary text-gray-100 font-bold">
                <tr>
                    <th class="py-2 pl-2">Order ID</th>
                    <th class="py-2 pl-2">Price</th>
                    <th class="py-2 pl-2">Payment</th>
                    <th class="py-2 pl-2">Status</th>
                    <th class="py-2 pl-2">Date</th>
                    <th class="py-2 pl-2">View Details</th>
                </tr>
                </thead>
                <tbody class="text-sm">
                @forelse($orders as $order)
                    <tr class="@if($loop->odd) bg-gray-100 @else bg-gray-200 @endif hover:bg-primary hover:bg-opacity-20 transition duration-200">
                        <td class="py-3 pl-2">
                            #{{$order->order_number}}
                        </td>
                        <td class="py-3 pl-2">
                            {{$order->grand_total}}
                        </td>
                        <td class="py-3 pl-2">
                            @if($order->payment_status === 5)
                                <span class="bg-warning px-1.5 py-0.5 rounded-lg text-gray-100">
                                    Pending
                                    </span>
                            @elseif($order->payment_status === 7)
                                <span class="bg-red-500 px-1.5 py-0.5 rounded-lg text-gray-100">
                                    Canceled
                                </span>
                            @else
                                <span class="bg-green-500 px-1.5 py-0.5 rounded-lg text-gray-100">
                                    Paid
                                </span>
                            @endif
                        </td>
                        <td class="py-3 pl-2">
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
                        <td class="py-3 pl-2">
                            {{ $order->created_at->format('F j, Y') }}
                        </td>
                        <td class="py-3 pl-2">
                            <a href="{{ route('account.order.show', $order->order_number) }}" class="bg-primary hover:bg-opacity-90 px-2 py-1 mr-2 text-gray-100 rounded-lg">View Details</a>
                        </td>
                    </tr>
                @empty
                    <tr class="bg-gray-100 hover:bg-primary hover:bg-opacity-20 transition duration-200">
                        <td class="py-3 pl-2 text-center" colspan="6">
                            No data
                        </td>
                    </tr>
                @endforelse

                </tbody>
            </table>
        </div>
    </div>
    <!-- end::Table -->

