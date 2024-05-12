<?php

namespace App\Http\Livewire\Admin\Logo;

use App\Models\Logo;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $file_path;
    
    protected $rules = [
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

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => __('CreatedMessage', ['name' => __('Logo') ])]);
        
        if($this->getPropertyValue('file_path') and is_object($this->file_path)) {
            $this->file_path = $this->getPropertyValue('file_path')->store('uploads/logo');
        }

        Logo::create([
            'file_path' => $this->file_path,            
        ]);

        $this->reset();
    }

    public function render()
    {
        return view('livewire.admin.logo.create')
            ->layout('admin::layouts.app', ['title' => __('CreateTitle', ['name' => __('Logo') ])]);
    }
}
