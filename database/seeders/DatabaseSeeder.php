<?php

namespace Database\Seeders;

use App\Models\Lottery;
use App\Models\Result;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $lottery = Lottery::create([
            'name' => 'Test Lottery',
            'description' => 'Test Lottery Description',
            'image' => 'https://via.placeholder.com/150',
            'pattern' => '/^\d{2}\s\d{2}\s\d{2}\s\d{2}$/'
        ]);

        // $result = Result::create([
        //     'lottery_id' => $lottery->id,
        //     'data' => '11 25 76 23',
        //     'date' => '2022-01-01',
        //     'round' => 1
        // ]);

        // $result2 = Result::create([
        //     'lottery_id' => $lottery->id,
        //     'data' => '78 43 28 92',
        //     'date' => '2022-01-02',
        //     'round' => 2
        // ]);
    }
}
