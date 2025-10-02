<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserProductSeeder extends Seeder
{
    public function run()
    {
        // Create admin user
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);

        // Create regular user
        $user = User::create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
        ]);

        // Create products for admin
        Product::create([
            'name' => 'Laptop',
            'description' => 'High-performance laptop for professionals',
            'price' => 999.99,
            'user_id' => $admin->id,
        ]);

        Product::create([
            'name' => 'Smartphone',
            'description' => 'Latest smartphone with advanced features',
            'price' => 699.99,
            'user_id' => $admin->id,
        ]);

        // Create products for regular user
        Product::create([
            'name' => 'Headphones',
            'description' => 'Wireless noise-cancelling headphones',
            'price' => 199.99,
            'user_id' => $user->id,
        ]);

        Product::create([
            'name' => 'Tablet',
            'description' => 'Portable tablet for work and entertainment',
            'price' => 499.99,
            'user_id' => $user->id,
        ]);

        // Create more test users and products
        User::factory(5)->create()->each(function ($user) {
            Product::factory(3)->create(['user_id' => $user->id]);
        });
    }
}
