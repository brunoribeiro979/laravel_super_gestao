<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\SiteContato;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // $this->call(FornecedorSeeder::class);
        // $this->call(SiteContatoSeeder::class);

        // quando usamos factories eh dessa forma que chamamos, a forma acima comentada eh quando apenas usamos seeders sem factories
        SiteContato::factory(100)->create();
        $this->call(MotivoContatoSeeder::class);
    }
}
