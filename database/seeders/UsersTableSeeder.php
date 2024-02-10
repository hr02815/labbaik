<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $emp = User::where("id",1)->first();
        \Log::info(date('1986-20-07 00:00:00'));
        
        if(!$emp){
            User::create(['name'=> 'ali', 
            'role_id'=> '1', 
            'email'=>'ali@gmail.com', 
            'phone'=>'090078601', 
            'cnic'=>'4200074150854', 
            'salary'=>'50',
            'password' =>'pass',
            'dob'=> date('1986-11-07')
        ]);
        }
    }
}
