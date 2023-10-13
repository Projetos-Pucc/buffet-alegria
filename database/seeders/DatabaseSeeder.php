<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(1)->create();

        User::factory()->create([
            'name' => 'Operacional',
            'email' => 'operacional@buffetalegria.com',
            'email_verified_at' => now(),
            "permission" => "operational",
            'password' => '$2y$12$Z/vhVO3e.UXKaG11EWgxc.EL7uej3Pi1M0Pq0orF5cbFGtyVh0V3C', // password
            'remember_token' => Str::random(10),
        ]);

        User::factory()->create([
            'name' => 'Administrativo',
            'email' => 'administracao@buffetalegria.com',
            'email_verified_at' => now(),
            "permission" => "administrative",
            'password' => '$2y$12$Z/vhVO3e.UXKaG11EWgxc.EL7uej3Pi1M0Pq0orF5cbFGtyVh0V3C', // password
            'remember_token' => Str::random(10),
        ]);

        User::factory()->create([
            'name' => 'Comercial',
            'email' => 'comercial@buffetalegria.com',
            'email_verified_at' => now(),
            "permission" => "commercial",
            'password' => '$2y$12$Z/vhVO3e.UXKaG11EWgxc.EL7uej3Pi1M0Pq0orF5cbFGtyVh0V3C', // password
            'remember_token' => Str::random(10),
        ]);

        User::factory()->create([
            'name' => 'Suporte',
            'email' => 'suporte@buffetalegria.com',
            'email_verified_at' => now(),
            "permission" => "commercial",
            'password' => '$2y$12$Z/vhVO3e.UXKaG11EWgxc.EL7uej3Pi1M0Pq0orF5cbFGtyVh0V3C', // password
            'remember_token' => Str::random(10),
        ]);

        User::factory()->create([
            'name' => 'Guilherme',
            'email' => 'guilherme@gmail.com',
            'email_verified_at' => now(),
            "permission" => "user",
            'password' => '$2y$12$Z/vhVO3e.UXKaG11EWgxc.EL7uej3Pi1M0Pq0orF5cbFGtyVh0V3C', // password
            'remember_token' => Str::random(10),
        ]);
    }
}
