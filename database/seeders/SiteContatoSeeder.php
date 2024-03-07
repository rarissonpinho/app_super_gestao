<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SiteContato;
use Faker\Factory;

class SiteContatoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\SiteContato::factory()->count(100)->create();

        /*
        $contato = new SiteContato();
        $contato->nome = 'Igor';
        $contato->telefone = '(48) 99954-1010';
        $contato->email = 'Igor@gmail.com';
        $contato->motivo_contato = 1;
        $contato->mensagem = 'Enviando email de teste';

        $contato->save();
        */

    }
}
