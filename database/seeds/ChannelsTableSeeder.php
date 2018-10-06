<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ChannelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('channels')->delete();

        DB::table('channels')->insert([
            'id' => 1,
            'name' => 'Backend',
            'slug' => 'backend',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('channels')->insert([
            'id' => 2,
            'name' => 'Web',
            'slug' => 'web',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('channels')->insert([
            'id' => 3,
            'name' => 'iOS',
            'slug' => 'ios',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('channels')->insert([
            'id' => 4,
            'name' => 'Android',
            'slug' => 'android',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('channels')->insert([
            'id' => 5,
            'name' => 'Others',
            'slug' => 'others',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
