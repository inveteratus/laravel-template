<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'Alan',
            'email' => 'alan.mcfarlane@gmail.com',
            'password' => '$2y$10$xz4oURfZBe6U2g5c2wwBMuHvoi9Jy6Rqk/cf024QmC.D9s9OQ2XXm',
        ]);
    }
}
