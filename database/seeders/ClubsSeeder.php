<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClubsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('clubs')->insert([
            [
                "name"=>"ชมรมบาสเกตบอล",
                "description"=>" เป็นกีฬาชนิดหนึ่งซึ่งแบ่งผู้เล่นเป็น 2 ทีม แต่ละทีม​ประกอบด้วยผู้เล่น 5 คนพยายามทำคะแนนโดยการโยนลูกเข้าห่วง",
                "facebook"=>"facebook.com/บาส",
                "phone"=>"0123456789",
                "vdo"=>"youtube.com/บาส",
                "faction"=>"ฝ่ายกีฬา",
                "open"=>true
            ],
            [
                "name"=>"ชมรมสันทนาการ",
                "description"=>"เพราะสันทนาการนั้นเป็นสิ่งที่สนุกสนานทำกันเป็น กลุ่ม นิยมใช้ร่วมกับการทำค่าย การจัดงานกีฬาสัมพันธ์ ทำให้เชื่อมความสัมพันธ์ระหว่างคณะหรือระหว่างมหาลัยได้ ",
                "facebook"=>"facebook.com/สันทนาการ",
                "phone"=>"0123456789",
                "vdo"=>"youtube.com/สันทนาการ",
                "faction"=>"ฝ่ายนักศึกษาสัมพันธ์",
                'open'=>false
        ]
        ]);
    }
}
