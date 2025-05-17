<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::query()
            ->where('username', 'admin@superadmin.com')
            ->first();

        if (empty($user)) {
            User::create([
                'name' => 'Admin Superadmin',
                'username' => 'admin@superadmin.com',
                'password' => bcrypt('P@ssw0rd'),
                'email' => 'admin@superadmin.com',
            ]);
        }
    }
}
