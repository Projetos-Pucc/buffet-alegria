<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\BookingStatus;
use App\Enums\QuestionType;
use App\Models\Booking;
use App\Models\OpenSchedule;
use App\Models\Recommendation;
use App\Models\SatisfactionAnswer;
use App\Models\SatisfactionQuestion;
use App\Models\SatisfactionSurvey;
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
            "party_day"=>date('Y-m-d', strtotime("2023-11-22")),
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
            "party_day"=>date('Y-m-d', strtotime("2023-11-22")),
            "open_schedule_id"=>3,
            "status"=>"A",
            "user_id"=>1,
            "package_id"=>1,
            "price"=>50,
        ]);

        Recommendation::create([
            'content' => '<p>🎉 Prepare-se para a festa mais divertida do ano! Estamos animados para convidar todos os pequenos a se juntarem a nós em uma celebração cheia de cores, brincadeiras e sorrisos. Não perca essa festa incrível!</p>'
        ]);
        
        Recommendation::create([
            'content' => '<p>🎈 Seus amiguinhos estão convocados para uma festa cheia de magia e diversão! Teremos jogos, guloseimas deliciosas e, é claro, muita música para animar a pista de dança dos pequenos. Estamos ansiosos para compartilhar momentos mágicos juntos!</p>'
        ]);
        
        Recommendation::create([
            'content' => '<p>🌟 A aventura vai começar! Estamos preparando uma festa incrível para os pequenos aventureiros. Com decoração temática, atividades emocionantes e um bolo delicioso, garantimos sorrisos do início ao fim. Esperamos por vocês!</p>'
        ]);
        
        Recommendation::create([
            'content' => '<p>🚀 Embarque nesta jornada festiva conosco! A festa espacial mais esperada do ano está chegando, com alienígenas amigáveis, planetas coloridos e muita diversão intergaláctica. Não perca essa experiência única!</p>'
        ]);
        
        Recommendation::create([
            'content' => '<p>🎨 Preparem seus pincéis e aventuras criativas! Nossa festa terá uma explosão de cores, atividades artísticas e muita alegria. Convidamos todos os pequenos artistas para uma tarde cheia de diversão e descobertas!</p>'
        ]);

        SatisfactionQuestion::create([
            'question'=>'O atendimento da equipe atendeu às suas expectativas?',
            'status'=>true,
            'question_type'=>QuestionType::M->name,
            'answers'=>1
        ]);
        SatisfactionQuestion::create([
            'question'=>'Deixe-nos saber mais sobre sua experiência. O que você achou mais notável ou o que poderia ser melhorado?',
            'status'=>true,
            'question_type'=>QuestionType::D->name,
            'answers'=>1
        ]);
        SatisfactionQuestion::create([
            'question'=>'O quanto recomendaria este evento para amigos e familiares',
            'status'=>true,
            'question_type'=>QuestionType::M->name,
            'answers'=>1
        ]);
        SatisfactionQuestion::create([
            'question'=>'Como você classificaria a variedade de opções de alimentação durante o evento?',
            'status'=>true,
            'question_type'=>QuestionType::M->name,
            'answers'=>1
        ]);

        SatisfactionAnswer::create([
            'question_id'=>'1',
            'booking_id'=>'1',
            'answer'=>'76-100%',
        ]);
        SatisfactionAnswer::create([
            'question_id'=>'2',
            'booking_id'=>'1',
            'answer'=>'Foi muito bom, atendeu todas as minhas expectativas!',
        ]);
        SatisfactionAnswer::create([
            'question_id'=>'3',
            'booking_id'=>'1',
            'answer'=>'76-100%',
        ]);
        SatisfactionAnswer::create([
            'question_id'=>'4',
            'booking_id'=>'1',
            'answer'=>'76-100%',
        ]);
    }
}
