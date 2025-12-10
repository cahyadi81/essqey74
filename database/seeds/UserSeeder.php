<?php

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
       	$user = new \App\User;
        $user->name = "bonjolman";
        $user->email = "bonjolman@gmail.com";
        $user->password = Hash::make("imamdwi123");
        $user->api_token = str_random(100);
        $user->save();
    }
}
