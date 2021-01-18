<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Service;


class DummySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->insert([
            'department_name' => 'IT',
        ]);
        DB::table('departments')->insert([
            'department_name' => 'Marketing',
        ]);
        DB::table('departments')->insert([
            'department_name' => 'Finance',
        ]);

        DB::table('positions')->insert([
            'position_name' => 'Developer',
            'department_id' => 1,
        ]);
        DB::table('positions')->insert([
            'position_name' => 'Tester',
            'department_id' => 1,
        ]);
        DB::table('positions')->insert([
            'position_name' => 'Sales',
            'department_id' => 2,
        ]);
        DB::table('positions')->insert([
            'position_name' => 'Marketing',
            'department_id' => 2,
        ]);
        DB::table('positions')->insert([
            'position_name' => 'Accountant',
            'department_id' => 3,
        ]);
        DB::table('positions')->insert([
            'position_name' => 'HR',
            'department_id' => 3,
        ]);

        DB::table('employees')->insert([
            'first_name' => 'Georgi',
            'last_name' => 'Georgiev',
            'address' => 'Varna, Podvis street',
            'phone' => '08956421333',
            'department_id' => 1,
            'position_id' => 2,
            'salary' => 1500,
        ]);
        DB::table('employees')->insert([
            'first_name' => 'Milena',
            'last_name' => 'Georgieva',
            'address' => 'Varna, Studentska street',
            'phone' => '0874513254',
            'department_id' => 2,
            'position_id' => 3,
            'salary' => 1300,
        ]);
        DB::table('employees')->insert([
            'first_name' => 'Petar',
            'last_name' => 'Petrov',
            'address' => 'Varna, Shipka street',
            'phone' => '0884485798',
            'department_id' => 3,
            'position_id' => 6,
            'salary' => 1800,
        ]);

        DB::table('users')->insert([
            'name' => 'Anul Muhsinov',
            'email' => 'amuhsinov@gmail.com',
            'password' => Hash::make('register1'),
        ]);
    }
}
