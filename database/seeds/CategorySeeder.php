<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Category::create([
            'name' => 'Main',

            'children' => [
                [
                    'name' => 'Sport',

                    'children' => [
                        [ 'name' => 'Shirts' ],
                        [ 'name' => 'T-Shirts' ],
                        [ 'name' => 'Socks' ],
                    ],

                ],
                [
                    'name' => 'Classic',

                    'children' => [
                        [ 'name' => 'Jackets' ],
                        [ 'name' => 'Sweaters' ],
                        [ 'name' => 'Shirts' ],
                    ],
                ],
                [
                    'name' => 'Casual',

                    'children' => [
                        [ 'name' => 'Jackets' ],
                        [ 'name' => 'Sweaters' ],
                        [ 'name' => 'Shirts' ],
                    ],
                ],
            ],
        ]);
    }
}
