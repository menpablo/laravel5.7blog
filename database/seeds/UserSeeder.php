<?php

use App\Enums\UserType;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::firstOrCreate(array(
            "first_name" => 'Admin',
            'last_name' => "",
            'role_id' => Role::where('description', UserType::ADMIN)->first()->id,
            'email'     => 'admin@blog.com',
            'password'  => Hash::make("superPassword123")
        ));
    }
}
