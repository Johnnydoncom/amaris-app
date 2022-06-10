<div>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <div class="card bg-white">
            <div class="card-body">

                <div class="flex justify-between gap-4 mb-4">
                    @if($platform)
                        <h3 class="font-semibold text-2xl">Edit Platform</h3>
                        <x-button class="btn btn-primary btn-sm" wire:click.prevent="resetForm" wire:loading.class="loading" wire:target="resetForm">Add New</x-button>
                    @else
                        <h3 class="font-semibold text-2xl">Add Platform</h3>
                    @endif
                </div>

                <form method="post" wire:submit.prevent="store">
                    @csrf
                    <div class="form-control mb-4">
                        <x-label>Platform Name</x-label>
                        <x-input wire:model.defer="name" required />
                    </div>
                    <div class="form-control mb-4">
                        <x-label for="image" :value="__('Featured Image')" />
                        <x-file-attachment wire:model="image" :file="$image" required="required" />
                    </div>
                    @if($platform)
                        <img src="{{$platform->getFirstMediaUrl('featured_image')}}" class="w-32 h-auto">
                    @endif

                    <div class="flex justify-end">
                        @if($platform)
                            <x-button class="btn btn-primary btn-sm" wire:loading.class="loading" wire:target="store">
                                <svg wire:loading role="status" class="inline w-4 h-4 mr-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                                </svg>
                                Update
                            </x-button>
                        @else
                            <x-button class="btn btn-primary btn-sm" wire:loading.class="loading" wire:target="store">Save</x-button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
        <div class="card bg-white">
            <div class="card-body">
                <h3 class="font-semibold text-2xl">Platforms</h3>
                <div>
                    <table class="w-full whitespace-nowrap">
                        <thead class="bg-secondary text-gray-100 font-bold">
                        <td class="py-2 pl-2">ID</td>
                        <td class="py-2 pl-2">Name</td>
                        <td class="py-2 pl-2">Product Count</td>
                        <td class="py-2 pl-2">Action</td>
                        </thead>
                        <tbody class="text-sm">
                        @forelse($platforms as $p)
                            <tr class="@if($loop->odd) bg-gray-100 @else bg-gray-200 @endif hover:bg-primary hover:bg-opacity-20 transition duration-200">
                                <td class="py-3 pl-2">
                                    #{{$p->id}}
                                </td>
                                <td class="py-3 pl-2">
                                    {{$p->name}}
                                </td>
                                <td class="py-3 pl-2">
                                    {{$p->products_count}}
                                </td>
                                <td class="py-3 pl-2 flex gap-2 justify-end">
                                    <a wire:click.prevent="editBrand({{$p->id}})" wire:loading.class="loading" wire:target="editBrand({{$p->id}})" href="#" class="btn btn-xs btn-primary rounded-lg border-none shadow-md rounded-md">
                                        <svg wire:loading role="status" class="inline w-4 h-4 mr-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                                        </svg>

                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </a>
                                    <button wire:click.prevent="deleteBrand({{$p->id}})" wire:loading.class="loading" wire:target="deleteBrand({{$p->id}})" class="btn btn-xs btn-error rounded-lg border-none shadow-md rounded-md">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </td>
                            </tr>
                        @empty

                        @endforelse
                        </tbody>
                        <tfoot class="">
                        <tr>
                            <td colspan="3">
                                <div class="mt-4">{{ $platforms->links() }}</div></td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
