<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenubarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (DB::table('tblmenubar')->count() === 0) {
            DB::table('tblmenubar')->insert([
                'navid' => 1,
                'name' => '',
                'nav1' => 'HOME',
                'nav2' => 'ABOUT',
                'nav3' => 'OUR PRODUCTS',
                'nav4' => 'VIDEO GAMES',
                'nav5' => 'REMOT CONTROL',
                'nav6' => 'CONTACT US',
                'nav7' => 'SIGN IN',
                'nav8' => 'REGISTER',
                'logo' => '1718100713.png',
                'create_at' => now(),
                'update_at' => now(),
                'whiteTitle' => 'Dai GAMES',
                'blueTitle' => 'BLACK',
                'description' => 'PlayStation Portal Remote Player. Play your PS5 console over your home Wi-Fi with console quality controls using PlayStation Portal Remote Player. Experience the incredible immersion of DualSense wireless controller features like haptic feedback and adaptive triggers.',
                'sliderImage' => '1718264138.png',
                'btnTitle' => 'Books',
                'whiteTitle2' => 'Sabay',
                'blueTitle2' => 'Digital',
                'description2' => 'Sony - PlayStation Portal Remote Player - White. High performance gaming gear and accessories.',
                'sliderImage2' => '1718162489.png',
                'btnTitle2' => 'Shop',
                'whiteTitle3' => 'Sony',
                'blueTitle3' => 'Headphone',
                'description3' => 'Engineered for high fidelity audio performance and ultra-low latency responsiveness.',
                'sliderImage3' => '1718264152.png',
                'btnTitle3' => 'GO To',
            ]);
        }
    }
}
