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
            'id_role'   => '2'
        ]);

        book::create([
            'bookTitle' => 'Wow',
            'id_category' => 1,
            'id_kelas'    => 1,
            'id_bookshelf'=> 3,
            'bookTotal'   => 10,
            'tax'         => 2000,
            'fine'        => 100000   
        ]);

        book::create([
            'bookTitle' => 'Wew',
            'id_category' => 1,
            'id_kelas'    => 3,
            'id_bookshelf'=> 1,
            'bookTotal'   => 10,
            'tax'         => 2000,
            'fine'        => 100000   
        ]);

        book::create([
            'bookTitle' => 'Waw',
            'id_category' => 1,
            'id_kelas'    => 2,
            'id_bookshelf'=> 2,
            'bookTotal'   => 10,
            'tax'         => 2000,
            'fine'        => 100000   
        ]);

        category::create([
            'category'  => 'Education'
        ]);

        category::create([
            'category'  => 'For Fun'
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
