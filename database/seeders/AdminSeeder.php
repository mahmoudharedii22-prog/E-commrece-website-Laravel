<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    protected $password = 'P12345678';

    /**
     * Create the initial admin user.
     */
    public function run(): void
    {
        $admin = User::firstOrCreate([
            'name' => 'Admin',
            'email' => 'admin@site.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'phone' => '01033867105',
            'is_active' => true,
        ]);
        $admin->assignRole('admin');
    }
}
