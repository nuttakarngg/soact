<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('answers')->insert([
            ['answer'=>"1","question_id"=>'1'],
            ['answer'=>"2","question_id"=>'1'],
            ['answer'=>"3","question_id"=>'1'],
            ['answer'=>"4","question_id"=>'1'],
            ['answer'=>"1","question_id"=>'2'],
            ['answer'=>"2","question_id"=>'2'],
            ['answer'=>"3","question_id"=>'2'],
            ['answer'=>"4","question_id"=>'2'],
            ['answer'=>"1","question_id"=>'3'],
            ['answer'=>"2","question_id"=>'3'],
            ['answer'=>"3","question_id"=>'3'],
            ['answer'=>"4","question_id"=>'3'],
            ['answer'=>"1","question_id"=>'4'],
            ['answer'=>"2","question_id"=>'4'],
            ['answer'=>"3","question_id"=>'4'],
            ['answer'=>"4","question_id"=>'4'],
            ['answer'=>"5","question_id"=>'5'],
            ['answer'=>"2","question_id"=>'5'],
            ['answer'=>"3","question_id"=>'5'],
            ['answer'=>"4","question_id"=>'5'],
        ]);
    }
}
