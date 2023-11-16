<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Package::factory()->create([
            'name_package'=>'Pacote União',
            'food_description'=>'coxinha, rissole, bolinha de queijo, salsicha empanada, bolo de chocolate, sorvete',
            'beverages_description'=>'agua, coca, guarana, suco de laranja',
            'photo_1'=>'169998221749.jpg',
            'photo_2'=>'169998221766.jpg',
            'photo_3'=>'169998221778.jpg',
            'slug'=>'uniao',
            'status'=>true,
            'price'=>55.5
        ]);
        Package::factory()->create([
            'name_package'=>'Pacote Familia',
            'food_description'=>'empada, pastelzinho, batata frita, croquete, sorvete, bolo de ninho com nuttela, algodão doce, churros',
            'beverages_description'=>'coca/zero, água, guaraná, suco de laranja, uva, morango',
            'photo_1'=>'169998221740.jpg',
            'photo_2'=>'169998221760.jpg',
            'photo_3'=>'169998221770.jpg',
            'slug'=>'familia',
            'status'=>true,
            'price'=>58
        ]);

        Package::factory()->create([
            'name_package'=>'Pacote Alegria',
            'food_description'=>'bauru, batata frita, pastel, espetinho, churros, fundoe, petit gateu, bolo da sua escolha',
            'beverages_description'=>'coca/zero, guarana, fanta, água, suco de laranja, morango, uva, maracúja',
            'photo_1'=>'169998221741.jpg',
            'photo_2'=>'169998221761.jpg',
            'photo_3'=>'169998221771.jpg',
            'slug'=>'alegria',
            'status'=>true,
            'price'=>52
        ]);
    }
}
