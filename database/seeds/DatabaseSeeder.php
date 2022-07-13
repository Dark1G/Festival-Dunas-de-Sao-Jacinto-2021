<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Evento;
use App\Sessao;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	$concerto = Evento::create([
            'nome' => "Concerto Kevin O Chris", 
            'slug' => Str::slug("Concerto Kevin O Chris")
        ]);

        $concerto2 = Evento::create([
            'nome' => "Concerto Tay",
            'slug' => Str::slug("Concerto Tay")
        ]);

        $concerto3 = Evento::create([
            'nome' => "Concerto João Pedro Pais",
            'slug' => Str::slug("Concerto João Pedro Pais")
        ]);

        Sessao::create([
            'dia' => 20,
            'evento_id' => $concerto->id
        ]);

        Sessao::create([
            'dia' => 21,
            'evento_id' => $concerto2->id
        ]);

        Sessao::create([
            'dia' => 22,
            'evento_id' => $concerto3->id
        ]);

        User::create([
            'name' => 'Geral',
            'email' => 'dunas@douromais.com',
            'password' => bcrypt('dunas#2021')
        ]);
    }
}
