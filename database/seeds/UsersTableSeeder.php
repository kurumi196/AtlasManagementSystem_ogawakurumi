<?php

use Illuminate\Database\Seeder;
use App\Models\Users\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            ['over_name' => 'Mickey',
            'under_name' => 'Mouse',
            'over_name_kana' => 'みっきー',
            'under_name_kana' => 'まうす',
            'mail_address' => 'mickey@com',
            'sex' => '1',
            'birth_day' => '2000-11-18',
            'role' => '3',
            'password' => bcrypt('11181118')]
        ]);
    }
}
