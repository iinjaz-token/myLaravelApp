<?php

namespace App\Http\Livewire\Admin\Header;

use App\Models\header;
use Livewire\Component;

class Single extends Component
{

    public $header;

    public function mount(Header $Header){
        $this->header = $Header;
    }

    public function delete()
    {
        $this->header->delete();
        $this->dispatchBrowserEvent('show-message', ['type' => 'error', 'message' => __('DeletedMessage', ['name' => __('Header') ]) ]);
        $this->emit('headerDeleted');
    }

    public function render()
    {
        return view('livewire.admin.header.single')
            ->layout('admin::layouts.app');
    }
}
