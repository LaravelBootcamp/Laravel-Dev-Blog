<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Supports\Database\GenaralSettingHelpers;

class DatabaseSeeder extends Seeder
{
    use GenaralSettingHelpers;
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::create([
            'name' => 'Biplob Shaha',
            'email' => 'devbipu@gmail.com',
            'password' => Hash::make('12121212'),
            'remember_token' => Str::random(10),
        ]);


        $this->addOrUpdate('site_title', 'Laravel Blog');
        $this->addOrUpdate('site_tagline', 'Laravel Blog');
    }
}
