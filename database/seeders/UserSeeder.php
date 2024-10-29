<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $mentorRole = Role::where('role_name', 'Mentor')->first();
        // $mentor = User::whereHas('userRole', function ($query) use ($mentorRole) {
        //     $query->where('role_id', $mentorRole->role_id);
        // })->first();
        \App\Models\User::create([
            'username'   => 'smartsoft',
            'password'   => bcrypt("admin"),
            'path_photo' => '/storage/user_profile/default.png',
            'name'       => 'Admin Smartsoft 1',
        ]);
        \App\Models\User::create([
            'username'  => 'smartsoft2',
            'password'   => bcrypt("admin"),
            'name'       => 'Admin Smartsoft 2',
        ]);
        \App\Models\User::create([
            'username'  => 'mentor',
            'password'   => bcrypt("admin"),
            'name'       => 'mentor',
        ]);
        \App\Models\User::create([
            'username'  => 'user',
            'password'   => bcrypt("admin"),
            'name'       => 'user',
            'mentor_id' => '3',
            'periode_id' => '1'
        ]);
    }
}
