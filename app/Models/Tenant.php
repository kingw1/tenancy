<?php

namespace App\Models;

use App\Traits\ActivityLogTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;
use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;

class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains, ActivityLogTrait, SoftDeletes;

    public static function getCustomColumns(): array
    {
        return [
            'id',
            'domain',
            'name',
            'address',
            'email',
            'phone',
        ];
    }

    protected function DomainName(): Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->domains->first()->domain ?? '-';
            }
        );
    }
}
