<tr x-data="{ modalIsOpen : false }">
    <td class="">{{ $header->name }}</td>
    
    @if(getCrudConfig('Header')->delete or getCrudConfig('Header')->update)
        <td>

            @if(getCrudConfig('Header')->update && hasPermission(getRouteName().'.header.update', 1, 1, $header))
                <a href="@route(getRouteName().'.header.update', $header->id)" class="btn text-primary mt-1">
                    <i class="icon-pencil"></i>
                </a>
            @endif

            @if(getCrudConfig('Header')->delete && hasPermission(getRouteName().'.header.delete', 1, 1, $header))
                <button @click.prevent="modalIsOpen = true" class="btn text-danger mt-1">
                    <i class="icon-trash"></i>
                </button>
                <div x-show="modalIsOpen" class="cs-modal animate__animated animate__fadeIn">
                    <div class="bg-white shadow rounded p-5" @click.away="modalIsOpen = false" >
                        <h5 class="pb-2 border-bottom">{{ __('DeleteTitle', ['name' => __('Header') ]) }}</h5>
                        <p>{{ __('DeleteMessage', ['name' => __('Header') ]) }}</p>
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