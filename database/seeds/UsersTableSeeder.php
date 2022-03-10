<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = app(Faker\Generator::class);
        // 头像假数据
        $avatars = [
            'https://cdn.learnku.com/uploads/images/201710/14/1/s5ehp11z6s.png',
            'https://cdn.learnku.com/uploads/images/201710/14/1/Lhd1SHqu86.png',
            'https://cdn.learnku.com/uploads/images/201710/14/1/LOnMrqbHJn.png',
            'https://cdn.learnku.com/uploads/images/201710/14/1/xAuDMxteQy.png',
            'https://cdn.learnku.com/uploads/images/201710/14/1/ZqM7iaP4CR.png',
            'https://cdn.learnku.com/uploads/images/201710/14/1/NDnzMutoxX.png',
        ];

        $users = factory(User::class)
            ->times(10)
            ->make()
            ->each(function($user, $index) use($faker, $avatars) {
                $user->avatar = $faker->randomElement($avatars);
            });
        $userArray = $users->makeVisible(['password', 'remember_token'])->toArray();

        User::insert($userArray);
        // // 单独处理第一个用户的数据
        // $user = User::find(1);
        // $user->name = '123';
        // $user->email = '123@example.com';
        // $user->avatar = 'https://cdn.learnku.com/uploads/images/201710/14/1/ZqM7iaP4CR.png';
        // $user->save();
    }
}
