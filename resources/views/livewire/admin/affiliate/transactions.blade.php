<x-card class="card bg-white">
    <div class="card-body">
        <h3 class="font-semibold text-2xl">Affiliate Transactions</h3>

        <div class="overflow-x-auto rounded-lg">
            <div class="align-middle inline-block min-w-full">
                <div class="shadow overflow-hidden sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                #ID
                            </th>
                            <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Customer
                            </th>
                            <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Type
                            </th>
                            <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Amount
                            </th>
                            <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Date
                            </th>
                            <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white">
                        @forelse($transactions as $transaction)
                            <tr class="@if($loop->even) bg-gray-50 @endif">
                                <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                    #{{$transaction->id}}
                                </td>
                                <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                    {{$transaction->payable->name}}
                                </td>
                                <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">
                                   {{$transaction->type}}
                                </td>
                                <td class="p-4 whitespace-nowrap text-sm text-gray-900">
                                    {{app_money_format($transaction->amount)}}
                                </td>
                                <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                    {{ $transaction->created_at->format('F j, Y') }}
                                </td>
                                <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                    @if($transaction->confirmed)
                                        <span class="bg-green-500 px-1.5 py-0.5 rounded-lg text-gray-100">
                                            Confirmed
                                        </span>
                                    @else
                                        <span class="bg-secondary px-1.5 py-0.5 rounded-lg text-gray-100">
                                            Pending
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                        @endforelse

                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="4">{!! $transactions->links() !!}</td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-card>
