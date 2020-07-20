<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Http\Eloquent\Entities\User;
use App\Http\Eloquent\Entities\Account;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Ahmad Qorib',
            'no_contact' => '089999999989'
        ]);

        Account::create([
            'email' => 'ahmad@gmail.com',
            'username' => 'ahmadqorib',
            'password' => Hash::make('123456'),
            'userable_id' => 1,
            'userable_type' => 'user'
        ]);
    }
}
