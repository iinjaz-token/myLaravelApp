<?php

namespace App\Http\Livewire\Admin\Titelbrand;

use App\Models\titelbrand;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;

    public $titelbrand;

    public $title;
    public $sub_title;
    
    protected $rules = [
        'title' => 'required',
        'sub_title' => 'required',        
    ];

    public function mount(Titelbrand $Titelbrand){
        $this->titelbrand = $Titelbrand;
        $this->title = $this->titelbrand->title;
        $this->sub_title = $this->titelbrand->sub_title;        
    }

    public function updated($input)
    {
        $this->validateOnly($input);
    }

    public function update()
    {
        if($this->getRules())
            $this->validate();

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => __('UpdatedMessage', ['name' => __('Titelbrand') ]) ]);
        
        $this->titelbrand->update([
            'title' => $this->title,
            'sub_title' => $this->sub_title,
            'user_id' => auth()->id(),
        ]);
    }

    public function render()
    {
        return view('livewire.admin.titelbrand.update', [
            'titelbrand' => $this->titelbrand
        ])->layout('admin::layouts.app', ['title' => __('UpdateTitle', ['name' => __('Titelbrand') ])]);
    }
}
