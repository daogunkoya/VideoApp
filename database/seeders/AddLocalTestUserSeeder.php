<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Process\FakeProcessResult;
use Illuminate\Support\Facades\App;

class AddLocalTestUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        if(App::environment() === 'local') {
            
            User::create([
                'name' => 'Test User',
                'email' => fake()->email(),
                'password' => bcrypt('password'),
            ]);
        }
    }
}
