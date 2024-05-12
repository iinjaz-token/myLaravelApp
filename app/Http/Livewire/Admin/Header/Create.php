<?php

namespace App\Http\Livewire\Admin\Header;

use App\Models\header;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $name;
    
    protected $rules = [
        'name' => 'required',        
    ];

    public function updated($input)
    {
        $this->validateOnly($input);
    }

    public function create()
    {
        if($this->getRules())
            $this->validate();

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => __('CreatedMessage', ['name' => __('Header') ])]);
        
        Header::create([
            'name' => $this->name,
            'user_id' => auth()->id(),
        ]);

        $this->reset();
    }

    public function render()
    {
        return view('livewire.admin.header.create')
            ->layout('admin::layouts.app', ['title' => __('CreateTitle', ['name' => __('Header') ])]);
    }
}
