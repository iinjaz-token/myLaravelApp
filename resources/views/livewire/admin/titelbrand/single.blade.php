<tr x-data="{ modalIsOpen : false }">
    <td class="">{{ $titelbrand->title }}</td>
    <td class="">{{ $titelbrand->sub_title }}</td>
    
    @if(getCrudConfig('Titelbrand')->delete or getCrudConfig('Titelbrand')->update)
        <td>

            @if(getCrudConfig('Titelbrand')->update && hasPermission(getRouteName().'.titelbrand.update', 1, 1, $titelbrand))
                <a href="@route(getRouteName().'.titelbrand.update', $titelbrand->id)" class="btn text-primary mt-1">
                    <i class="icon-pencil"></i>
                </a>
            @endif

            @if(getCrudConfig('Titelbrand')->delete && hasPermission(getRouteName().'.titelbrand.delete', 1, 1, $titelbrand))
                <button @click.prevent="modalIsOpen = true" class="btn text-danger mt-1">
                    <i class="icon-trash"></i>
                </button>
                <div x-show="modalIsOpen" class="cs-modal animate__animated animate__fadeIn">
                    <div class="bg-white shadow rounded p-5" @click.away="modalIsOpen = false" >
                        <h5 class="pb-2 border-bottom">{{ __('DeleteTitle', ['name' => __('Titelbrand') ]) }}</h5>
                        <p>{{ __('DeleteMessage', ['name' => __('Titelbrand') ]) }}</p>
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
