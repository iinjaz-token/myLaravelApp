<?php

namespace App\Http\Livewire\Admin\Header;

use App\Models\header;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;

    public $header;

    public $name;
    
    protected $rules = [
        'name' => 'required',        
    ];

    public function mount(Header $Header){
        $this->header = $Header;
        $this->name = $this->header->name;        
    }

    public function updated($input)
    {
        $this->validateOnly($input);
    }

    public function update()
    {
        if($this->getRules())
            $this->validate();

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => __('UpdatedMessage', ['name' => __('Header') ]) ]);
        
        $this->header->update([
            'name' => $this->name,
            'user_id' => auth()->id(),
        ]);
    }

    public function render()
    {
        return view('livewire.admin.header.update', [
            'header' => $this->header
        ])->layout('admin::layouts.app', ['title' => __('UpdateTitle', ['name' => __('Header') ])]);
    }
}
