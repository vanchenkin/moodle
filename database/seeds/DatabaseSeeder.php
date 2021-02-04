<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Иванов Иван Иванович',
            'username' => 'system',
            'password' => Hash::make('system567812'),
            'role' => 'SYSTEM'
        ]);
    }
}
