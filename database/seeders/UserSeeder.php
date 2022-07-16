<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'biodata' => 'bio'
        ]);


        $customerservice = User::create([
            'name' => 'customerservice',
            'username' => 'customerservice',
            'email' => 'customerservice@gmail.com',
            'password' => Hash::make('customerservice'),
            'biodata' => 'bio'
        ]);

        $kabaganalis = User::create([
            'name' => 'kabaganalis',
            'username' => 'kabaganalis',
            'email' => 'kabaganalis@gmail.com',
            'password' => Hash::make('kabaganalis'),
            'biodata' => 'bio'
        ]);

        $staffanalis = User::create([
            'name' => 'staffanalis',
            'username' => 'staffanalis',
            'email' => 'staffanalis@gmail.com',
            'password' => Hash::make('staffanalis'),
            'biodata' => 'bio'
        ]);

        $nasabah = User::create([
            'name' => 'nasabah',
            'username' => 'nasabah',
            'email' => 'nasabah@gmail.com',
            'password' => Hash::make('nasabah'),
            'biodata' => 'bio'
        ]);

        $admin->assignRole('admin');
        $customerservice->assignRole('customerservice');
        $kabaganalis->assignRole('kabaganalis');
        $staffanalis->assignRole('staffanalis');
        $nasabah->assignRole('nasabah');
    }
}
