<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('admins')->insert([
            [
                "firstname"=>"ณัฐกานต์",
                "lastname"=>"สัธนานันต์",
                "username"=>"superj",
                "password"=>Hash::make("password"),
                "phone"=>"0123456789",
                "faction"=>"อดีตสโมสรนักศึกษา",
                "email"=>"nuttakarngg@gmail.com",
                "role"=>"0"
            ],
            [
                "firstname"=>"เมธิชัย",
                "lastname"=>"จำไม่ได้",
                "username"=>"matichai",
                "password"=>Hash::make("password"),
                "phone"=>"0123456789",
                "faction"=>"มหาเทพแห่งองค์การนักศึกษา",
                "email"=>"ไม่รู้@gmail.com",
                "role"=>"0"
        ]
        ]);;
    }
}
