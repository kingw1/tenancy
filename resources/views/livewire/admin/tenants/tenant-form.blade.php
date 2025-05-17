<div>
    <x-header title="{{ is_object($tenant) ? 'Edit' : 'Create new' }} Tenant" separator progress-indicator />
    <x-form wire:submit="{{ is_object($tenant) ? 'update' : 'store' }}">
        <div class="grid lg:grid-cols-2 gap-8">
            <x-card title="Tenant Info" subtitle="Your tenant information">
                <div class="space-y-3">
                    <x-input
                        label="Name"
                        wire:model="name"
                        placeholder="Name"
                    />
                    <x-textarea
                        label="Address"
                        wire:model="address"
                        placeholder="Address"
                    />
                    <x-input
                        label="Email"
                        wire:model="email"
                        placeholder="Email"
                    />
                    <x-input
                        label="Contact Phone"
                        wire:model="phone"
                        placeholder="Contact Phone"
                    />
                </div>
            </x-card>

            <div class="grid content-start gap-8">
                <x-card title="Domain" subtitle="Your tenant domain">
                    <div class="space-y-3">
                        <x-input
                            label="Domain"
                            wire:model="domain"
                            placeholder="Domain"
                            prefix="https://"
                            suffix="{{ config('app.domain') }}"
                        />
                    </div>
                </x-card>
            </div>
        </div>

        <x-slot:actions>
            <x-button label="{{ __('Cancel') }}" link="{{ route('admin.tenant.index') }}" />
            <x-button
                label="{{ __('Save') }}"
                icon="o-paper-airplane"
                class="btn-primary"
                type="submit"
                spinner="{{ is_object($tenant) ? 'update' : 'store' }}"
            />
        </x-slot:actions>
    </x-form>
</div>