<?php

namespace Database\Seeders;

use App\Models\Central\Clinic;
use App\Models\Central\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (User::count() == 0) {
            User::create([
                'name'           => 'System Admin',
                'email'          => 'admin@dentalcrm.intranet',
                'password'       => bcrypt('Pass123456'),
                'remember_token' => Str::random(60),
                'email_verified_at' => gmdate('Y-m-d H:i:s'),
            ]);
        }

        if (Clinic::count() == 0) {
            Clinic::create([
                'name' => 'Lema Dental Clinic Istanbul',
                'vat_number' => '1111-1111',
                'website' => 'https://lemaclinic.com/',
                'email' => 'contact@lemaclinic.com',
                'phone' => '+90 542 107 1632',
                'location' => 'Başakşehir, İshakpaşa Sokağı, 34480 Başakşehir/İstanbul'
            ]);
        }
    }
}
