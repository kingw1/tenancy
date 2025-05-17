<?php

use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Login;
use App\Livewire\Admin\Logout;
use App\Livewire\Admin\Tenants\TenantForm;
use App\Livewire\Admin\Tenants\TenantList;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect()->route('admin.dashboard'))->name('index');

Route::get('login', Login::class)->name('login');

Route::middleware('auth')
    ->group(function () {
        Route::get('logout', Logout::class)->name('logout');
        Route::get('dashboard', Dashboard::class)->name('dashboard');

        Route::prefix('tenant')->name('tenant.')->group(function () {
            Route::get('/', TenantList::class)->name('index');
            Route::get('create', TenantForm::class)->name('create');
            Route::get('{id}/edit', TenantForm::class)->name('edit');
        });
    });
