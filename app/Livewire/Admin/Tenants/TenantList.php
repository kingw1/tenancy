<?php

namespace App\Livewire\Admin\Tenants;

use App\Repositories\TenantRepository;
use Livewire\Component;
use Livewire\WithPagination;
use Mary\Traits\Toast;

class TenantList extends Component
{
    use Toast, WithPagination;

    private TenantRepository $tenantRepo;
    public string $search = '';
    public array $sortBy = ['column' => 'name', 'direction' => 'desc'];

    public bool $confirmingDelete = false;
    public string $selectedDeleteId = '';
    public string $selectedDeleteName = '';

    public function __construct()
    {
        $this->tenantRepo = new TenantRepository;
    }

    public function headers(): array
    {
        return [
            ['key' => 'name', 'label' => 'Name', 'class' => 'w-20'],
            ['key' => 'domain', 'label' => 'Domain', 'class' => 'w-20'],
            ['key' => 'phone', 'label' => 'Phone', 'class' => 'w-20'],
            ['key' => 'email', 'label' => 'Email', 'class' => 'w-20'],
        ];
    }

    public function render()
    {
        return view('livewire.admin.tenants.tenant-list', [
            'headers' => $this->headers(),
            'tenants' => $this->tenantRepo->paginate([
                'search' => $this->search
            ])
        ]);
    }

    public function confirmDelete($id, $name)
    {
        $this->selectedDeleteId = $id;
        $this->selectedDeleteName = $name;
        $this->confirmingDelete = true;
    }

    public function delete()
    {
        // delete

        $this->confirmingDelete = false;
        $this->selectedDeleteId = '';

        $this->success(
            __('Delete Successfully'),
            redirectTo: route('admin.tenant.index')
        );
    }
}
