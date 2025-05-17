<div>
    <h1>
        ยินดีต้อนรับ {{ auth()->user()->name }}
    </h1>

    <div class="mt-5">
        <x-button label="Logout" class="btn-primary" link="{{ route('admin.logout') }}" />
    </div>
</div>
