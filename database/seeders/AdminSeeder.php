<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::where('email','thuwaiba@gmail.com')->first();
        if(!$admin){
            User::create([
                "firstname" => "Thuwaiba",
                "middlename" => "Kombo",
                "lastname" => "Ali",
                "mobile" => "077484837",
                "gender" => "Female",
                "role" => "admin",
                "email" => "thuwaiba@gmail.com",
                "password" => Hash::make("12345"),
            ]);
        }
    }
}
