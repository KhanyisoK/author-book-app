<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Author::create([
            'name' => 'Shoes',
            'surname' => 'Mosh'
        ]);
        Author::create([
            'name' => 'Sarah',
            'surname' => 'Buns'
         ]);
         Author::create([
            'name' => 'May',
            'surname' => 'June'
         ]);
         Author::create([
            'name' => 'Nana',
            'surname' => 'Baba'
         ]);
         Author::create([
            'name' => 'Lolly',
            'surname' => 'Maina'
         ]);
    }
}
