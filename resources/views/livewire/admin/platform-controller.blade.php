<div>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <x-card class="card bg-white">
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
                    <div class="form-controll mb-4">
                        <x-label>Platform Name</x-label>
                        <x-input wire:model.defer="name" name="name" id="name" class="w-full" required />
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
                            <x-button class="btn btn-primary btn-sm" wire:loading.class="loading" wire:target="store">Update</x-button>
                        @else
                            <x-button class="btn btn-primary btn-sm" wire:loading.class="loading" wire:target="store">Save</x-button>
                        @endif
                    </div>
                </form>
            </div>
        </x-card>
        <x-card class="card bg-white">
            <div class="card-body">
                <h3 class="font-semibold text-2xl">Platforms</h3>
                <div>
                    <table class="w-full whitespace-nowrap">
                        <thead class="bg-primary text-gray-100 font-bold">
                        <td class="py-2 pl-2">ID</td>
                        <td class="py-2 pl-2">Name</td>
                        <td class="py-2 pl-2">Product Count</td>
                        <td class="py-2 pr-2 text-right">Action</td>
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
                                <td class="py-3 pr-2 flex gap-2 justify-end">
                                    <a wire:click.prevent="editBrand({{$p->id}})" wire:loading.class="loading" wire:target="editBrand({{$p->id}})" href="#" class="btn btn-xs btn-primary rounded-lg border-none shadow-md rounded-md">
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
        </x-card>
    </div>
</div>
