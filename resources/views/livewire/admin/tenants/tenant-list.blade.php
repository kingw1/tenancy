<div>
    <x-header title="Tenant" separator progress-indicator>
        <x-slot:middle class="!justify-end">
            <x-input
                placeholder="Search..."
                wire:model.live.debounce="search"
                clearable
                icon="o-magnifying-glass"
            />
        </x-slot:middle>
        <x-slot:actions>
            <x-button label="Create" icon="o-plus" class="btn-primary" link="{{ route('admin.tenant.create') }}" />
        </x-slot:actions>
    </x-header>

    <x-card>
        <x-table :headers="$headers" :rows="$tenants" :sort-by="$sortBy" with-pagination show-empty-text empty-text="{{ __('No records found') }}">
            @scope('cell_domain', $tenant)
                <a href="//{{ $tenant->domain_name }}" target="_blank" class="hover:text-primary">{{ $tenant->domain_name }}</a>
            @endscope

            @scope('actions', $tenant)
                <x-button
                    icon="o-pencil-square"
                    link="{{ route('admin.tenant.edit', $tenant->id) }}"
                    spinner
                    class="btn-ghost btn-sm"
                />
                <x-button
                    icon="o-trash"
                    class="btn-ghost btn-sm text-error"
                    wire:click="confirmDelete('{{ $tenant->id }}', '{{ $tenant->name }}')"
                    spinner
                />
            @endscope
        </x-table>
    </x-card>

    <x-modal
        wire:model="confirmingDelete"
        title="{{ __('Confirm delete') }}"
        persistent
        class="backdrop-blur"
        separator
    >
        <x-form>
            <div class="flex flex-col justify-center items-center gap-3 mb-5">
                <x-icon name="s-exclamation-triangle" class="w-9 h-9 text-red-500 text-2xl" />
                <p>{{ __('Are you sure you want to delete') }}</p>
                <p><strong>{{ $selectedDeleteName }}</strong></p>
            </div>

            <x-slot:actions>
                <div class="flex justify-center gap-5 w-full">
                    <x-button label="Cancel" class="w-1/2" @click="$wire.confirmingDelete = false" />
                    <x-button label="Confirm" class="btn-error w-1/2" @click="$wire.delete() = false" />
                </div>
            </x-slot:actions>
        </x-form>
    </x-modal>
</div>