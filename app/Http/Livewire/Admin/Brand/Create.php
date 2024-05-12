<?php

namespace App\Http\Livewire\Admin\Brand;

use App\Models\brand;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $name;
    public $file_path;
    
    protected $rules = [
        'name' => 'required|string|max:255',
        'file_path' => 'required|image|max:2048',        
    ];

    public function updated($input)
    {
        $this->validateOnly($input);
    }

    public function create()
    {
        if($this->getRules())
            $this->validate();

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => __('CreatedMessage', ['name' => __('Brand') ])]);
        
        if($this->getPropertyValue('file_path') and is_object($this->file_path)) {
            $this->file_path = $this->getPropertyValue('file_path')->store('uploads/brands');
        }

        Brand::create([
            'name' => $this->name,
            'file_path' => $this->file_path,
            'user_id' => auth()->id(),
        ]);

        $this->reset();
    }

    public function render()
    {
        return view('livewire.admin.brand.create')
            ->layout('admin::layouts.app', ['title' => __('CreateTitle', ['name' => __('Brand') ])]);
    }
}
