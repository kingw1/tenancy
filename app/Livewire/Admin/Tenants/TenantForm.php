<?php

namespace App\Livewire\Admin\Tenants;

use App\Models\Tenant;
use App\Repositories\TenantRepository;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Mary\Traits\Toast;

class TenantForm extends Component
{
    use Toast;

    private $tenantRepo;
    public ?Tenant $tenant = null;

    // form
    public string $domain;
    public string $name;
    public ?string $address;
    public ?string $email;
    public ?string $phone;

    public function __construct()
    {
        $this->tenantRepo = new TenantRepository;
    }

    public function mount(string $id = '')
    {
        $this->tenant = $this->tenantRepo->find($id);
        $this->setFormData();
    }

    private function setFormData()
    {
        if (is_object($this->tenant)) {
            $this->domain = $this->tenant->domain;
            $this->name = $this->tenant->name;
            $this->address = $this->tenant->address;
            $this->email = $this->tenant->email;
            $this->phone = $this->tenant->phone;
        }
    }

    public function store()
    {
        $validated = $this->validate([
            'domain' => 'required|alpha|unique:tenants',
            'name' => 'required',
            'address' => 'nullable',
            'email' => 'nullable|email',
            'phone' => 'nullable',
        ]);

        $this->tenantRepo->store($validated);

        $this->success(__('Create Successfully'), redirectTo: route('admin.tenant.index'));
    }

    public function update()
    {
        $validated = $this->validate([
            'domain' => ['required', 'alpha', Rule::unique('tenants')->ignore($this->tenant)->whereNull('deleted_at')],
            'name' => 'required',
            'address' => 'nullable',
            'email' => 'nullable|email',
            'phone' => 'nullable',
        ]);

        $this->tenantRepo->update($this->tenant->id, $validated);

        $this->success(__('Update Successfully'), redirectTo: route('admin.tenant.index'));
    }

    public function render()
    {
        return view('livewire.admin.tenants.tenant-form');
    }
}
