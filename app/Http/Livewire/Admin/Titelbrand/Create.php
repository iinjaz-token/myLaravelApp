<?php

namespace App\Http\Livewire\Admin\Titelbrand;

use App\Models\titelbrand;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $title;
    public $sub_title;
    
    protected $rules = [
        'title' => 'required',
        'sub_title' => 'required',        
    ];

    public function updated($input)
    {
        $this->validateOnly($input);
    }

    public function create()
    {
        if($this->getRules())
            $this->validate();

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => __('CreatedMessage', ['name' => __('Titelbrand') ])]);
        
        Titelbrand::create([
            'title' => $this->title,
            'sub_title' => $this->sub_title,
            'user_id' => auth()->id(),
        ]);

        $this->reset();
    }

    public function render()
    {
        return view('livewire.admin.titelbrand.create')
            ->layout('admin::layouts.app', ['title' => __('CreateTitle', ['name' => __('Titelbrand') ])]);
    }
}
