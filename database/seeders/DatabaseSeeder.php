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
                'email_verified_at' =>gmdate('Y-m-d H:i:s'),
            ]);
        }

        if(Clinic::count() == 0){
            Clinic::create([
                'name' => 'Inter Dental Center',
                'vat_number' => '111-111-111',
                'website' => 'www.interdentalcenter.com',
                'email' => 'info@interdentalcenter.com',
                'phone' => '(+355) 42 23 40 40',
                'location' => '8RH8+P65, Rruga e Durrësit, Tiranë, Albania'
            ]);
        }
    }
}
