<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // $this->call(InventorySeeder::class);
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'username' => 'admin',
            'password' => 'admin123',
            'remember_token' => Str::random(10)
        ]);
        // \App\Models\User::factory()->create([
        //     'username' => 'manajemen123',
        //     'password' => '@ABC*123#manajemen',
        //     'remember_token' => Str::random(10)
        // ]);
    }
}
