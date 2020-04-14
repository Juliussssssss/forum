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
                'is_admin' => 1,
                'email_verified_at' => \Carbon\Carbon::now(),
                'created_at' => \Carbon\Carbon::now()
            ],
            [
                'name' => 'Juliusss2',
                'email' => 'terminatorexpert@gmail.com',
                'password' => bcrypt('secret'),
                'is_admin' => 0,
                'email_verified_at' => null,
                'created_at' => \Carbon\Carbon::now()
            ]
        ];

        DB::table('users')->insert($data);
    }
}
