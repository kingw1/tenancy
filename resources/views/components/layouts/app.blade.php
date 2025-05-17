<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($title) ? $title.' - '.config('app.name') : config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen font-sans antialiased bg-base-200">

    {{-- NAVBAR mobile only --}}
    <x-nav sticky class="lg:hidden">
        <x-slot:brand>
            @if (request()->routeIs('admin.*'))
            <x-admin-brand />
            @else
            <x-app-brand />
            @endif
        </x-slot:brand>
        <x-slot:actions>
            <label for="main-drawer" class="lg:hidden me-3">
                <x-icon name="o-bars-3" class="cursor-pointer" />
            </label>
        </x-slot:actions>
    </x-nav>

    {{-- MAIN --}}
    <x-main full-width>
        {{-- SIDEBAR --}}
        <x-slot:sidebar drawer="main-drawer" collapsible class="bg-base-100 lg:bg-inherit">

            {{-- BRAND --}}
            <div class="ml-5 pt-5">
                @if (request()->routeIs('admin.*'))
                <x-admin-brand />
                @else
                <x-app-brand />
                @endif
            </div>

            {{-- MENU --}}
            <x-menu activate-by-route>

                {{-- User --}}
                @if($user = auth()->user())
                    <x-menu-separator />

                    <x-list-item :item="$user" value="name" sub-value="email" no-separator no-hover class="-mx-2 !-my-2 rounded">
                        <x-slot:actions>
                            <x-dropdown right>
                                <x-slot:trigger>
                                    <x-button icon="o-cog-6-tooth" class="btn-circle" />
                                </x-slot:trigger>

                                <x-menu-item
                                    title="{{ __('Sign out') }}"
                                    icon="o-power"
                                    link="{{ route('admin.logout') }}"
                                />
                                <x-menu-item
                                    title="{{ __('Toggle Theme') }}"
                                    icon="o-sparkles"
                                    @click="$dispatch('mary-toggle-theme')"
                                />
                            </x-dropdown>
                        </x-slot:actions>
                    </x-list-item>

                    <x-menu-separator />
                @endif

                @include('components.layouts.'.request()->segment(1).'.menu-item')
            </x-menu>
        </x-slot:sidebar>

        <x-slot:content>
            {{ $slot }}
        </x-slot:content>
    </x-main>

    <x-toast />

    <x-theme-toggle class="hidden" />
</body>
</html>
