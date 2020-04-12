<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UsersTableSeeder extends Seeder
{
    /**
     * Загрузка начальных данных.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Juliusss',
                'email' => '2000ulik@gmail.com',
                'password' => bcrypt('secret'),
            ],
            [
                'name' => 'Juliusss2',
                'email' => 'terminatorexpert@gmail.com',
                'password' => bcrypt('secret'),
            ]
        ];

        DB::table('users')->insert($data);
    }
}
