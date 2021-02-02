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
            'name' => 'Владимир',
            'surname' => 'Новиков',
            'username' => 'admin',
            'password' => Hash::make('admin'),
            'role' => 'ADMIN'
        ]);
        DB::table('users')->insert([
            'name' => 'Владимир',
            'surname' => 'Новиков',
            'username' => 'system',
            'password' => Hash::make('system'),
            'role' => 'SYSTEM'
        ]);
        DB::table('users')->insert([
            'name' => 'Владимир',
            'surname' => 'Новиков',
            'username' => 'user',
            'password' => Hash::make('user'),
            'role' => 'STUDENT'
        ]);
        DB::table('users')->insert([
            'name' => 'Владимир',
            'surname' => 'Новиков',
            'username' => 'ssdi',
            'password' => Hash::make('ssdi'),
            'role' => 'TEACHER'
        ]);
        DB::table('groups')->insert([
            'name' => '11Г1',
        ]);
        DB::table('group_user')->insert([
            'user_id' => '3',
            'group_id' => '1',
        ]);
        DB::table('group_user')->insert([
            'user_id' => '4',
            'group_id' => '1',
        ]);
        DB::table('modules')->insert([
            'name' => 'ООП',
        ]);
        DB::table('tasks')->insert([
            'text' => '2+2',
            'answer' => '4',
            'module_id' => '1',
        ]);
    }
}
