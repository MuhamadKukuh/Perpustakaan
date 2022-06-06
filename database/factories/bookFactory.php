<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\book>
 */
class bookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'bookTitle' => 'No game no Life',
            'id_category' => 2,
            'id_kelas'    => 1,
            'genre'    => "Action, Romance, Comedy, Drama",
            'id_bookshelf'=> 3,
            'bookTotal'   => 10,
            'tax'         => 2000,
            'bookImage'   => '1649856044.png',
            'fine'        => 100000   
        ];
    }
}
