<?php

namespace App\Http\Livewire\Admin\Brand;

use App\Models\brand;
use Livewire\Component;

class Single extends Component
{

    public $brand;

    public function mount(Brand $Brand){
        $this->brand = $Brand;
    }

    public function delete()
    {
        $this->brand->delete();
        $this->dispatchBrowserEvent('show-message', ['type' => 'error', 'message' => __('DeletedMessage', ['name' => __('Brand') ]) ]);
        $this->emit('brandDeleted');
    }

    public function render()
    {
        return view('livewire.admin.brand.single')
            ->layout('admin::layouts.app');
    }
}
