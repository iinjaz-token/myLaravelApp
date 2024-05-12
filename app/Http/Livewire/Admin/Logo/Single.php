<?php

namespace App\Http\Livewire\Admin\Logo;

use App\Models\Logo;
use Livewire\Component;

class Single extends Component
{

    public $logo;

    public function mount(Logo $Logo){
        $this->logo = $Logo;
    }

    public function delete()
    {
        $this->logo->delete();
        $this->dispatchBrowserEvent('show-message', ['type' => 'error', 'message' => __('DeletedMessage', ['name' => __('Logo') ]) ]);
        $this->emit('logoDeleted');
    }

    public function render()
    {
        return view('livewire.admin.logo.single')
            ->layout('admin::layouts.app');
    }
}
