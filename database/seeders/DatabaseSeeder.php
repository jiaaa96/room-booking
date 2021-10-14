<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
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
        //create satu record
        // \App\Models\User::create([
        //     'name' => 'User',
        //     'email' => 'user@domain.com',
        //     'email_verified_at' => now(),
        //     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        //     'remember_token' => Str::random(10),

        // ]);

            $this->call([
                PermissionSeeder::class
            ]);

        // \App\Models\User::factory(10)->create();
        \App\Models\Room::factory(20)->create();
        \App\Models\Booking::factory(20)->create();
    }
}
