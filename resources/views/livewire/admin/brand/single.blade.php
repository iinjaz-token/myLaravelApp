<tr x-data="{ modalIsOpen : false }">
    <td class="">{{ $brand->file_path }}</td>
    <td class="">{{ $brand->name }}</td>
    
    @if(getCrudConfig('Brand')->delete or getCrudConfig('Brand')->update)
        <td>

            @if(getCrudConfig('Brand')->update && hasPermission(getRouteName().'.brand.update', 1, 1, $brand))
                <a href="@route(getRouteName().'.brand.update', $brand->id)" class="btn text-primary mt-1">
                    <i class="icon-pencil"></i>
                </a>
            @endif

            @if(getCrudConfig('Brand')->delete && hasPermission(getRouteName().'.brand.delete', 1, 1, $brand))
                <button @click.prevent="modalIsOpen = true" class="btn text-danger mt-1">
                    <i class="icon-trash"></i>
                </button>
                <div x-show="modalIsOpen" class="cs-modal animate__animated animate__fadeIn">
                    <div class="bg-white shadow rounded p-5" @click.away="modalIsOpen = false" >
                        <h5 class="pb-2 border-bottom">{{ __('DeleteTitle', ['name' => __('Brand') ]) }}</h5>
                        <p>{{ __('DeleteMessage', ['name' => __('Brand') ]) }}</p>
                        <div class="mt-5 d-flex justify-content-between">
                            <a wire:click.prevent="delete" class="text-white btn btn-success shadow">{{ __('Yes, Delete it.') }}</a>
                            <a @click.prevent="modalIsOpen = false" class="text-white btn btn-danger shadow">{{ __('No, Cancel it.') }}</a>
                        </div>
                    </div>
                </div>
            @endif
        </td>
    @endif
</tr>
