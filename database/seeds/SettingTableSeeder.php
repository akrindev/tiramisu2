<?php

use App\Setting;
use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $data = [
      	'body' => [
          'badword' => 'porno'
        ]
      ];

      Setting::create($data);
    }
}