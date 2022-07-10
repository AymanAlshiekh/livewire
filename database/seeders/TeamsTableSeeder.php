<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Team::create([
            'user_id'           =>  User::where('email', 'ayman@gmail.com')->first()->id,
            'name'              => 'personal',
            'personal_team'     => true,
        ]);
    }
}
