<?php

use App\ForumCategory;
use Illuminate\Database\Seeder;

class ForumCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ForumCategory::create([
            'name' => 'Diskusi Umum',
            'slug' => 'diskusi-umum',
        ]);
    }
}
