<?php

use App\User;
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
        // Hash::make($data['password'])
        $fakeusers = [
            ['name' => 'user1', 'email' => 'user1@user1.it', 'password' => '12345678'],
            ['name' => 'user2', 'email' => 'user2@user2.it', 'password' => '12345678'],
            ['name' => 'user3', 'email' => 'user3@user3.it', 'password' => '12345678'],
        ];

        foreach ($fakeusers as $fakeuser) {
            $user = new User();
            $user->name = $fakeuser['name'];
            $user->email = $fakeuser['email'];
            $user->password = Hash::make($fakeuser['password']);
            $user->save();
        }
    }
}