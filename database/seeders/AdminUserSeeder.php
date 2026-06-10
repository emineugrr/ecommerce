<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Rolleri otomatik oluştur (Hocanın phpMyAdmin'den yaptığı işlem)
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'description' => 'Administrator role']);
        $userRole = Role::firstOrCreate(['name' => 'user', 'description' => 'Regular user role']);

        // Admin kullanıcısını oluştur
        $adminUser = User::updateOrCreate(
            ['email' => 'admin@mysite.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('12345')
            ]
        );

        // Kullanıcıya admin ve user rollerini ata
        $adminUser->roles()->syncWithoutDetaching([
            $adminRole->id,
            $userRole->id,
        ]);
    }
}
