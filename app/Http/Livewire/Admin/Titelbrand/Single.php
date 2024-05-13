<?php

namespace App\Http\Livewire\Admin\Titelbrand;

use App\Models\titelbrand;
use Livewire\Component;

class Single extends Component
{

    public $titelbrand;

    public function mount(Titelbrand $Titelbrand){
        $this->titelbrand = $Titelbrand;
    }

    public function delete()
    {
        $this->titelbrand->delete();
        $this->dispatchBrowserEvent('show-message', ['type' => 'error', 'message' => __('DeletedMessage', ['name' => __('Titelbrand') ]) ]);
        $this->emit('titelbrandDeleted');
    }

    public function render()
    {
        return view('livewire.admin.titelbrand.single')
            ->layout('admin::layouts.app');
    }
}
