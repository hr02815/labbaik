<?php

namespace Database\Seeders;
use App\Models\Role;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $role = Role::where("name","admin")->first();

        if(!$role){
            Role::create(['name' => 'admin']);
        }
        $this->call(UsersTableSeeder::class);
    }
}
