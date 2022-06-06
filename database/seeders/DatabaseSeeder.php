<?php

namespace Database\Seeders;

use App\Models\book;
use App\Models\User;
use App\Models\kelas;
use App\Models\gender;
use App\Models\category;
use App\Models\bookshelf;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        kelas::create([
            'kelas' => "X-RPL"
        ]);

        kelas::create([
            'kelas' => "XI-RPL"
        ]);

        kelas::create([
            'kelas' => "XI-RPL"
        ]);

        gender::create([
            'gender' => "Boy"
        ]);

        gender::create([
            'gender' => "Girl"
        ]);

        User::create([
            'username'  => 'Apple',
            'id_kelas'  => '2',
            'id_gender' => '1',
            'email'     => 'apple@gmail.com',
            'password'  => Hash::make('password'),
            'nis'       => '20211054',
            'id_role'   => '2'
        ]);

        User::create([
            'username'  => 'Shiroo',
            'id_kelas'  => '2',
            'id_gender' => '2',
            'email'     => 'shiro@gmail.com',
            'password'  => Hash::make('password'),
            'nis'       => '20211055',
            'id_role'   => '1'
        ]);

        for($i = 1; $i <= 3; $i++){
            book::create([
                'bookTitle' => 'Kamisato Art',
                'id_category' => 1,
                'id_kelas'    => 0,
                'genre'    => "Slice Of Life, Comedy",
                'id_bookshelf'=> 1,
                'bookTotal'   => 10,
                'tax'         => 2000,
                'bookImage'   => 'gambar.jpg',
                'fine'        => 100000   
            ]);
        }

        for($i = 1; $i <= 3; $i++){
            book::create([
                'bookTitle' => 'No game no Life',
                'id_category' => 2,
                'id_kelas'    => 1,
                'genre'    => "Action, Romance, Comedy, Drama",
                'id_bookshelf'=> 1,
                'bookTotal'   => 10,
                'tax'         => 2000,
                'bookImage'   => '1649856044.png',
                'fine'        => 100000   
            ]);
        }

        for($i = 1; $i <= 3; $i++){
            book::create([
                'bookTitle' => 'No game no Life',
                'id_category' => 1,
                'id_kelas'    => 1,
                'genre'    => "Action, Romance, Comedy, Drama",
                'id_bookshelf'=> 3,
                'bookTotal'   => 10,
                'tax'         => 2000,
                'bookImage'   => '1649856044.png',
                'fine'        => 100000   
            ]);
        }

        for($i = 1; $i <= 3; $i++){
            book::create([
                'bookTitle' => 'No game no Life',
                'id_category' => 2,
                'id_kelas'    => 1,
                'genre'    => "Action, Romance, Comedy, Drama",
                'id_bookshelf'=> 2,
                'bookTotal'   => 10,
                'tax'         => 2000,
                'bookImage'   => '1649856044.png',
                'fine'        => 100000   
            ]);
        }

        // book::create([
        //     'bookTitle' => 'Wew',
        //     'id_category' => 1,
        //     'id_kelas'    => 3,
        //     'id_bookshelf'=> 1,
        //     'genre'    => "Romance, School, Comedy",
        //     'bookTotal'   => 10,
        //     'bookImage'   => '20220225142827.png',
        //     'tax'         => 2000,
        //     'fine'        => 100000   
        // ]);

        // book::create([
        //     'bookTitle' => 'Waw',
        //     'id_category' => 2,
        //     'id_kelas'    => 2,
        //     'id_bookshelf'=> 2,
        //     'genre'    => "Slice of Life, Comedy",
        //     'bookTotal'   => 10,
        //     'tax'         => 2000,
        //     'bookImage'   => '20220225142835.png',
        //     'fine'        => 100000   
        // ]);

        category::create([
            'category'  => 'Fiction'
        ]);

        category::create([
            'category'  => 'Non Fiction'
        ]);

        bookshelf::create([
            'nameBookshelf'  => 'Rak A'
        ]);

        bookshelf::create([
            'nameBookshelf'  => 'Rak B'
        ]);

        bookshelf::create([
            'nameBookshelf'  => 'Rak C'
        ]);

    }
}
