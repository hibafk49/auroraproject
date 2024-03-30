<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UpdateUserPasswords extends Command
{
    protected $signature = 'users:update-passwords';
    protected $description = 'Update user passwords to use Bcrypt hashing';
    public function handle()
    {
        $users = User::all();

        foreach ($users as $user) {
            $user->password = Hash::make($user->password);
            $user->save();
        }

        $this->info('User passwords updated successfully.');
    }
}
