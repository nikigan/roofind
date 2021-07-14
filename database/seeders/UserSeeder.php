<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserType;
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
        $user_type = UserType::query()->create([
            "name" => "Частный мастер"
        ]);

        User::query()->create([
            "name" => "Иван",
            "family_name" => "Иванов",
            "email" => "user@mail.com",
            "email_verified_at" => now(),
            "user_type_id" => $user_type->id,
            "password" => Hash::make("password"),
            "description" => "asjdn oajsd okaj dkajsp djapk jdpak jsdpk ajspdkj askjdaksjdpka sjd akspdjapsj apksd"
        ]);
    }
}
