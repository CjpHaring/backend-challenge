<?php

namespace Database\Seeders;

use App\Models\Player;
use Illuminate\Database\Seeder;

class PlayerSeeder extends Seeder {
    /**
     * @return void
     */
    public function run(): void
    {
        Player::factory()->count(4)->create();
    }
}
