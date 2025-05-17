<div class="flex min-h-full">
    <div class="flex flex-1 flex-col justify-center px-4 py-12 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
        <div class="mx-auto w-full max-w-sm lg:w-96">
            <h1 class="mt-8 text-3xl font-bold text-gray-900">
                Admin Panel
            </h1>
            <div class="mt-5">
                <div>
                    <x-form wire:submit="login">
                        <x-input
                            label="Username"
                            wire:model="username"
                            placeholder="Username"
                            icon-right="o-user"
                        />

                        <x-password
                            label="Password"
                            wire:model="password"
                            placeholder="Password"
                            right
                        />

                        <x-button label="Sign in" type="submit" class="btn-primary" spinner />

                        @if (session()->has('message'))
                            <x-alert
                                title="{{ session('message') }}"
                                icon="o-exclamation-triangle"
                                class="alert-warning"
                            />
                        @endif
                    </x-form>
                </div>
            </div>
        </div>
    </div>
    <div class="relative hidden w-0 flex-1 lg:block">
        <img class="absolute inset-0 size-full object-cover"
            src="https://images.unsplash.com/photo-1496917756835-20cb06e75b4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1908&q=80"
            alt="">
    </div>
</div>
