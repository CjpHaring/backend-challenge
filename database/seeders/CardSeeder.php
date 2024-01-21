<?php

namespace Database\Seeders;

use App\Models\Card;
use Illuminate\Database\Seeder;

class CardSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run(): void
    {
        $types = ['hearts', 'clubs', 'diamonds', 'spades'];
        $numbers = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A'];

        foreach ($types as $type) {
            foreach ($numbers as $number) {
                Card::create(['type' => $type, 'number' => $number]);
            }
        }
    }
}
