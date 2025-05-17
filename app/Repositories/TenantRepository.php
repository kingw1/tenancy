<?php

namespace App\Repositories;

use App\Models\Tenant;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class TenantRepository
{
    public function find(string $id): Tenant|null
    {
        return Tenant::find($id);
    }

    public function query(array $filters = []): Builder
    {
        return Tenant::query()
            ->when($filters['search'] ?? null, function ($query, $value) {
                return $query->whereLike('name', "%{$value}%")
                    ->orWhereLike('domain', "%{$value}%")
                    ->orWhereLike('email', "%{$value}%")
                    ->orWhereLike('phone', "%{$value}%");
            });
    }

    public function paginate(array $filters = [], $perPage = 10): LengthAwarePaginator
    {
        return $this->query($filters)
            ->latest()
            ->paginate($perPage);
    }

    public function store(array $data): Tenant
    {
        $data['domain'] = Str::lower($data['domain']);

        $tenant = $this->valuable(new Tenant, $data);

        $tenant->domains()->create([
            'domain' => $data['domain'] . '.' . config('app.domain')
        ]);

        return $tenant;
    }

    public function update(string $id, array $data): Tenant
    {
        $tenant = $this->find($id);

        return $this->valuable($tenant, $data);
    }

    public function valuable(Tenant $tenant, array $param = []): Tenant
    {
        $param = (object) $param;

        !isset($param->name) ?: $tenant->name = $param->name;
        !isset($param->domain) ?: $tenant->domain = $param->domain;
        !isset($param->address) ?: $tenant->address = $param->address;
        !isset($param->email) ?: $tenant->email = $param->email;
        !isset($param->phone) ?: $tenant->phone = $param->phone;

        $tenant->save();

        return $tenant;
    }
}
