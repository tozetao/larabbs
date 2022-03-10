<?php

use App\Models\Category;
use Illuminate\Database\Seeder;
use App\Models\Topic;
use App\Models\User;

class TopicsTableSeeder extends Seeder
{
    public function run()
    {
        $userIDs = User::all()->pluck('id')->toArray();
        $categoryIDs = Category::all()->pluck('id')->toArray();

        $faker = app(Faker\Generator::class);

        $topics = factory(Topic::class)->times(50)->make()
            ->each(function ($topic, $index) use($faker, $userIDs, $categoryIDs) {
                $topic->user_id = $faker->randomElement($userIDs);
                $topic->category_id = $faker->randomElement($categoryIDs);
            });

        Topic::insert($topics->toArray());
    }

}

