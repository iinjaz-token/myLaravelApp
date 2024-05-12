<?php

namespace App\Http\Livewire\Admin\Logo;

use App\Models\Logo;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;

    public $logo;

    public $file_path;
    
    protected $rules = [
        'file_path' => 'required|image|max:2048',        
    ];

    public function mount(Logo $Logo){
        $this->logo = $Logo;
        $this->file_path = $this->logo->file_path;        
    }

    public function updated($input)
    {
        $this->validateOnly($input);
    }

    public function update()
    {
        if($this->getRules())
            $this->validate();

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => __('UpdatedMessage', ['name' => __('Logo') ]) ]);
        
        if($this->getPropertyValue('file_path') and is_object($this->file_path)) {
            $this->file_path = $this->getPropertyValue('file_path')->store('uploads/logo');
        }

        $this->logo->update([
            'file_path' => $this->file_path,            
        ]);
    }

    public function render()
    {
        return view('livewire.admin.logo.update', [
            'logo' => $this->logo
        ])->layout('admin::layouts.app', ['title' => __('UpdateTitle', ['name' => __('Logo') ])]);
    }
}
