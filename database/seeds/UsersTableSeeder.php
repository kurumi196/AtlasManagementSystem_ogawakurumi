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
            // ['over_name' => 'Mickey',
            // 'under_name' => 'Mouse',
            // 'over_name_kana' => 'みっきー',
            // 'under_name_kana' => 'まうす',
            // 'mail_address' => 'mickey@com',
            // 'sex' => '1',
            // 'birth_day' => '2000-11-18',
            // 'role' => '3',
            // 'password' => bcrypt('11181118')],
            ['over_name' => 'Goofy',
            'under_name' => 'Goof',
            'over_name_kana' => 'グーフィー',
            'under_name_kana' => 'グーフ',
            'mail_address' => 'goofy@com',
            'sex' => '1',
            'birth_day' => '2000-05-25',
            'role' => '4',
            'password' => bcrypt('05250525')],
            ['over_name' => 'Daisy',
            'under_name' => 'Duck',
            'over_name_kana' => 'デイジー',
            'under_name_kana' => 'ダック',
            'mail_address' => 'daisy@com',
            'sex' => '2',
            'birth_day' => '2000-01-09',
            'role' => '4',
            'password' => bcrypt('01090109')],
            ['over_name' => '生徒',
            'under_name' => 'A',
            'over_name_kana' => 'セイト',
            'under_name_kana' => 'エー',
            'mail_address' => 'A@com',
            'sex' => '1',
            'birth_day' => '2000-01-01',
            'role' => '4',
            'password' => bcrypt('00000001')],
            ['over_name' => '生徒',
            'under_name' => 'B',
            'over_name_kana' => 'セイト',
            'under_name_kana' => 'ビー',
            'mail_address' => 'B@com',
            'sex' => '2',
            'birth_day' => '2000-02-02',
            'role' => '4',
            'password' => bcrypt('00000002')],
            ['over_name' => '生徒',
            'under_name' => 'C',
            'over_name_kana' => 'セイト',
            'under_name_kana' => 'シー',
            'mail_address' => 'C@com',
            'sex' => '1',
            'birth_day' => '2000-03-03',
            'role' => '4',
            'password' => bcrypt('00000003')],
        ]);
    }
}
