<?php

use App\Enums\UserType;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::firstOrCreate(array("description" => UserType::ADMIN));
        Role::firstOrCreate(array("description" => UserType::BLOGGER));
        Role::firstOrCreate(array("description" => UserType::SUPERVISOR));
    }
}
