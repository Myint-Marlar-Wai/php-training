<?php

use Illuminate\Database\Seeder;

class DefautlStudentSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        DB::table('student')->delete();
        $objs = array(
            ['id'=>1, 'full_name'=>'Mg Mg', 'phone_no' => '09450026588', 'address' => 'Yangon'],
            ['id'=>2, 'full_name'=>'Hla Hla', 'phone_no' => '09758452630', 'address' => 'Bago']
        );
        DB::table('student')->insert($objs);
    }
}
