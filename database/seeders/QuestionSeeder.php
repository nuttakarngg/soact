<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('questions')->insert([
            [
                'question'=>'ตอบเลข 1',
                'show'=>true,
                'answer' => '1',
                "club_id"=>"1"
            ],
            [
                'question'=>'ตอบเลข 2',
                'show'=>true,
                'answer' => '2',
                "club_id"=>"1"
            ],
            [
                'question'=>'ตอบเลข 3',
                'show'=>true,
                'answer' => '3',
                "club_id"=>"1"
            ],
            [
                'question'=>'ตอบเลข 4',
                'show'=>true,
                'answer' => '4',
                "club_id"=>"1"
            ],
            [
                'question'=>'ตอบเลข 5',
                'show'=>true,
                'answer' => '5',
                "club_id"=>"1"
            ]
        ]);
    }
}
