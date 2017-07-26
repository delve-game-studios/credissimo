<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::insert([
            'name' => 'Counter-Strike 1.6',
            'slug' => 'counter-strike-16',
            'description' => "Play the world's number 1 online action game. Engage in an incredibly realistic brand of terrorist warfare in this wildly popular team-based game. Ally with teammates to complete strategic missions. Take out enemy sites. Rescue hostages. Your role affects your team's success. Your team's success affects your role.",
            'price' => 9.99,
            'image' => '',
        ]);
        Product::insert([
            'name' => 'Half-Life',
            'slug' => 'half-life',
            'description' => "Named Game of the Year by over 50 publications, Valve's debut title blends action and adventure with award-winning technology to create a frighteningly realistic world where players must think to survive. Also includes an exciting multiplayer mode that allows you to play against friends and enemies around the world.",
            'price' => 9.99,
            'image' => '',
        ]);
        Product::insert([
            'name' => 'Portal',
            'slug' => 'portal',
            'description' => "Portal™ is a new single player game from Valve. Set in the mysterious Aperture Science Laboratories, Portal has been called one of the most innovative new games on the horizon and will offer gamers hours of unique gameplay.",
            'price' => 9.99,
            'image' => '',
        ]);
        Product::insert([
            'name' => 'ARK: Survival Evolved',
            'slug' => 'ark-survival-evolved',
            'description' => "As a man or woman stranded naked, freezing & starving on a mysterious island, you must hunt, harvest, craft items, grow crops, & build shelters to survive. Use skill & cunning to kill, tame, breed, & ride Dinosaurs & primeval creatures living on ARK, and team up with hundreds of players or play locally!",
            'price' => 59.99,
            'image' => '',
        ]);
        Product::insert([
            'name' => 'Garry\'s Mod',
            'slug' => 'garrys-mod',
            'description' => "Garry's Mod is a physics sandbox. There aren't any predefined aims or goals. We give you the tools and leave you to play.",
            'price' => 9.99,
            'image' => '',
        ]);
        Product::insert([
            'name' => 'Sniper Elite',
            'slug' => 'sniper-elite',
            'description' => "As World War II draws to a close, the first covert battles of the Cold War begin. Caught in the life and death struggle between Soviets and Germans in war-torn Berlin, you control the fate of a lone American OSS Sniper.",
            'price' => 7.99,
            'image' => '',
        ]);
        Product::insert([
            'name' => 'FlatOut 2™',
            'slug' => 'flatout-2',
            'description' => "DRIVING THIS RECKLESS IS NO ACCIDENT!\n\nBut you might want to cause a few. In these high-speed races, the more damage you inflict, the better. The ultimate in turbo-charged cars and the craziest competitor drivers are waiting to test your best destructive streak. Responsible drivers need not apply.",
            'price' => 9.99,
            'image' => '',
        ]);
    }
}
