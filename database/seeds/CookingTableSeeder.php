<?php

use App\Cooking;
use Illuminate\Database\Seeder;

class CookingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => null,
                'buff' => 'STR +',
                'stat' => 2,
                'pt' => null,
            ],
            [
                'name' => null,
                'buff' => 'INT +',
                'stat' => 2,
                'pt' => null,
            ],
            [
                'name' => null,
                'buff' => 'VIT +',
                'stat' => 2,
                'pt' => null,
            ],
            [
                'name' => null,
                'buff' => 'AGI +',
                'stat' => 2,
                'pt' => null,
            ],
            [
                'name' => null,
                'buff' => 'DEX +',
                'stat' => 2,
                'pt' => null,
            ],
            [
                'name' => null,
                'buff' => 'Accuracy +',
                'stat' => 6,
                'pt' => null,
            ],
            [
                'name' => null,
                'buff' => 'Dodge +',
                'stat' => 6,
                'pt' => null,
            ],
            [
                'name' => null,
                'buff' => 'DEF +',
                'stat' => 20,
                'pt' => null,
            ],
            [
                'name' => null,
                'buff' => 'MDEF +',
                'stat' => 20,
                'pt' => null,
            ],
            [
                'name' => null,
                'buff' => 'MATK +',
                'stat' => 6,
                'pt' => null,
            ],
            [
                'name' => null,
                'buff' => 'ATK +',
                'stat' => 6,
                'pt' => null,
            ],
            [
                'name' => null,
                'buff' => 'Weapon ATK +',
                'stat' => 6,
                'pt' => null,
            ],
            [
                'name' => null,
                'buff' => 'Kekebalan Fisik +%',
                'stat' => 4,
                'pt' => null,
            ],
            [
                'name' => null,
                'buff' => 'Kekebalan Sihir +%',
                'stat' => 4,
                'pt' => null,
            ],
            [
                'name' => null,
                'buff' => 'Kebal Api +%',
                'stat' => 2,
                'pt' => null,
            ],
            [
                'name' => null,
                'buff' => 'Kebal Air +%',
                'stat' => 2,
                'pt' => null,
            ],
            [
                'name' => null,
                'buff' => 'Kebal Angin +%',
                'stat' => 2,
                'pt' => null,
            ],
            [
                'name' => null,
                'buff' => 'Kebal Bumi +%',
                'stat' => 2,
                'pt' => null,
            ],
            [
                'name' => null,
                'buff' => 'Kebal Normal +%',
                'stat' => 2,
                'pt' => null,
            ],
            [
                'name' => null,
                'buff' => 'Kebal Gelap +%',
                'stat' => 2,
                'pt' => null,
            ],
            [
                'name' => null,
                'buff' => 'Kebal Cahaya +%',
                'stat' => 2,
                'pt' => null,
            ],
            [
                'name' => null,
                'buff' => 'Drop Rate +%',
                'stat' => 1,
                'pt' => null,
            ],
            [
                'name' => null,
                'buff' => 'EXP Gain +%',
                'stat' => 1,
                'pt' => null,
            ],
            [
                'name' => null,
                'buff' => 'Luka ke Angin +%',
                'stat' => 1,
                'pt' => null,
            ],
            [
                'name' => null,
                'buff' => 'Luka ke Air +%',
                'stat' => 1,
                'pt' => null,
            ],
            [
                'name' => null,
                'buff' => 'Luka ke Api +%',
                'stat' => 1,
                'pt' => null,
            ],
            [
                'name' => null,
                'buff' => 'Luka ke Bumi +%',
                'stat' => 1,
                'pt' => null,
            ],
            [
                'name' => null,
                'buff' => 'Luka ke Normal +%',
                'stat' => 1,
                'pt' => null,
            ],
            [
                'name' => null,
                'buff' => 'Luka ke Cahaya +%',
                'stat' => 1,
                'pt' => null,
            ],
            [
                'name' => null,
                'buff' => 'Luka ke Gelap +%',
                'stat' => 1,
                'pt' => null,
            ],
            [
                'name' => null,
                'buff' => 'Pelindung Fisik +',
                'stat' => 400,
                'pt' => null,
            ],
            [
                'name' => null,
                'buff' => 'Pelindung Sihir +',
                'stat' => 400,
                'pt' => null,
            ],
            [
                'name' => null,
                'buff' => 'Pelindung Fraksional +%',
                'stat' => 2,
                'pt' => null,
            ],
            [
                'name' => null,
                'buff' => 'Critical Rate +',
                'stat' => 2,
                'pt' => null,
            ],
            [
                'name' => null,
                'buff' => 'Attack MP Recovery +',
                'stat' => 2,
                'pt' => null,
            ],
            [
                'name' => null,
                'buff' => 'Aggro +%',
                'stat' => 6,
                'pt' => null,
            ],
            [
                'name' => null,
                'buff' => 'Aggro -%',
                'stat' => 6,
                'pt' => null,
            ],
            [
                'name' => null,
                'buff' => 'MaxHP +',
                'stat' => 400,
                'pt' => null,
            ],
            [
                'name' => null,
                'buff' => 'MaxMP +',
                'stat' => 60,
                'pt' => null,
            ],
        ];
        Cooking::insert($data);
    }
}
