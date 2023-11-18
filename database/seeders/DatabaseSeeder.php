<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\BookingStatus;
use App\Models\Booking;
use App\Models\OpenSchedule;
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

        $this->call([
            PermissionsSeeder::class,
            PackageSeeder::class
        ]);

        $operational = User::factory()->create([
            'name' => 'Operacional',
            'email' => 'operacional@buffetalegria.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$d1GtfTTungciG2JXfgIHyuUv61Z7aJU736cdXxvfvgxVpPXVjY99C', // password = 'teste123'
            'remember_token' => Str::random(10),
        ]);
        $operational->assignRole('operational');

        $administrative= User::factory()->create([
            'name' => 'Administrativo',
            'email' => 'administracao@buffetalegria.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$d1GtfTTungciG2JXfgIHyuUv61Z7aJU736cdXxvfvgxVpPXVjY99C', // password = 'teste123'
            'remember_token' => Str::random(10),
        ]);
        $administrative->assignRole('administrative');

        $commercial= User::factory()->create([
            'name' => 'Comercial',
            'email' => 'comercial@buffetalegria.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$d1GtfTTungciG2JXfgIHyuUv61Z7aJU736cdXxvfvgxVpPXVjY99C', // password = 'teste123'
            'remember_token' => Str::random(10),
        ]);
        $commercial->assignRole('commercial');

        $support = User::factory()->create([
            'name' => 'Suporte',
            'email' => 'suporte@buffetalegria.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$d1GtfTTungciG2JXfgIHyuUv61Z7aJU736cdXxvfvgxVpPXVjY99C', // password = 'teste123'
            'remember_token' => Str::random(10),
        ]);
        $support->assignRole('commercial');

        $user = User::factory()->create([
            'name' => 'Guilherme',
            'email' => 'guilherme@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$d1GtfTTungciG2JXfgIHyuUv61Z7aJU736cdXxvfvgxVpPXVjY99C', // password = 'teste123'
            'remember_token' => Str::random(10),
        ]);
        $user->assignRole('user');

        OpenSchedule::create(
            ['time'=>"12:00:00", 'hours'=>3, 'status'=>true]
        );
        OpenSchedule::create(
            ['time'=>"16:00:00", 'hours'=>2, 'status'=>true]
        );
        OpenSchedule::create(
            ['time'=>"19:00:00", 'hours'=>3, 'status'=>true]
        );

        Booking::create([
            "name_birthdayperson"=>"nome1",
            "years_birthdayperson"=>5,
            "qnt_invited"=>5,
            "party_day"=>date('Y-m-d', strtotime("2023-11-15")),
            "open_schedule_id"=>1,
            "status"=>"A",
            "user_id"=>1,
            "package_id"=>1,
            "price"=>50,
        ]);
        Booking::create([
            "name_birthdayperson"=>"nome1",
            "years_birthdayperson"=>5,
            "qnt_invited"=>5,
            "party_day"=>date('Y-m-d', strtotime("2023-11-15")),
            "open_schedule_id"=>3,
            "status"=>"A",
            "user_id"=>1,
            "package_id"=>1,
            "price"=>50,
        ]);
    }
}
