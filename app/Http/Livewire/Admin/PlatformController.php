<?php

namespace App\Http\Livewire\Admin;

use App\Models\Platform;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class PlatformController extends Component
{
    use WithPagination, WithFileUploads;

    public $platform, $name, $image;

    protected $rules = [
        'name' => 'required'
    ];

    public function render()
    {
        return view('livewire.admin.platform-controller')->with([
            'platforms' => Platform::withCount('products')->paginate()
        ])->layout('layouts.admin');
    }

    public function editBrand($id){
        $this->platform = Platform::find($id);
        $this->name = $this->platform->name;
    }

    public function store(){
        $this->validate();

        $platform = $this->platform ?? new Platform();
        $platform->name = $this->name;
        $platform->save();

        if($this->image){
            $platform
                ->addMedia($this->image->getRealPath())
                ->toMediaCollection('featured_image');
        }

        if(!$this->platform)
            $this->reset(['name']);

        // Set Flash Message
        $this->dispatchBrowserEvent('alert',[
            'type'=>'success',
            'message'=>"Record Saved!"
        ]);
    }

    public function deletePlatform($id){
        $this->platform = Platform::find($id)->delete();

        $this->dispatchBrowserEvent('alert',[
            'type'=>'error',
            'message'=>"Record Deleted!"
        ]);
    }

    public function resetForm(){
        $this->reset();
    }
}
