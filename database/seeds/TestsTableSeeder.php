<?php

use Illuminate\Database\Seeder;

class TestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tests')->insert([
            [
                'name' => '商品A',
                'price' => '100'
            ],
            [
                'name' => '商品B',
                'price' => '200'
            ],
            [
                'name' => '商品C',
                'price' => '300'
            ],
          ]);
    }
}
