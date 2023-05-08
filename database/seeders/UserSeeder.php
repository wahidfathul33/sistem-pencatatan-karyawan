<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        self::createUser([
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => '12345678',
            'desa_id' => null
        ], 'admin');

        self::createUser([
            'username' => 'desa1',
            'email' => 'desa1@gmail.com',
            'password' => '12345678',
            'desa_id' => 1
        ], 'desa');

        self::createUser([
            'username' => 'desa2',
            'email' => 'desa2@gmail.com',
            'password' => '12345678',
            'desa_id' => 2
        ], 'desa');
    }

    private function createUser(array $data, string $role)
    {
        $user = User::create($data);

        $user->assignRole($role);
    }
}
