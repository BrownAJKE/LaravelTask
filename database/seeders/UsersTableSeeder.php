<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = User::create([
            'name' => 'Felix Mutinda',
            'email' => 'bken0480@gmail.com',
            'is_admin' => true,
            'password' => Hash::make('felixmutinda048')
        ]);
    }
}
