<?php

namespace Database\Seeders;

use App\Models\Freight;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\OrderFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->admin()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        Freight::factory(30)->create();

        $this->call([
           ProductSeeder::class,
            OrderSeeder::class,
        ]);
    }
}
