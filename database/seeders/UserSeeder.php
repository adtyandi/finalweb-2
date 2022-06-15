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
            'password' => Hash::make('admin')
        ]);


        $customerservice = User::create([
            'name' => 'customerservice',
            'username' => 'customerservice',
            'email' => 'customerservice@gmail.com',
            'password' => Hash::make('customerservice')
        ]);

        $kabaganalis = User::create([
            'name' => 'kabaganalis',
            'username' => 'kabaganalis',
            'email' => 'kabaganalis@gmail.com',
            'password' => Hash::make('kabaganalis')
        ]);

        $staffanalis = User::create([
            'name' => 'staffanalis',
            'username' => 'staffanalis',
            'email' => 'staffanalis@gmail.com',
            'password' => Hash::make('staffanalis')
        ]);

        $nasabah = User::create([
            'name' => 'nasabah',
            'username' => 'nasabah',
            'email' => 'nasabah@gmail.com',
            'password' => Hash::make('nasabah')
        ]);

        $admin->assignRole('admin');
        $customerservice->assignRole('customerservice');
        $kabaganalis->assignRole('kabaganalis');
        $staffanalis->assignRole('staffanalis');
        $nasabah->assignRole('nasabah');
    }
}
