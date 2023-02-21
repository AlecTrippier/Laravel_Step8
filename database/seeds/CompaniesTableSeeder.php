<?php

use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->insert([

            [
                'company_name' => 'A社',
                'street_address' => 'A地区',
                'representative_name' => 'A太郎ーーー',
            ],
            [
                'company_name' => 'B社',
                'street_address' => 'B地区',
                'representative_name' => 'B太郎',
            ],
            [
                'company_name' => 'C社',
                'street_address' => 'C地区',
                'representative_name' => 'C太郎',
            ],
            [
                'company_name' => 'D社',
                'street_address' => 'D地区',
                'representative_name' => 'D太郎',
            ],
            [
                'company_name' => 'E社',
                'street_address' => 'E地区',
                'representative_name' => 'E太郎',
            ],
            [
                'company_name' => 'F社',
                'street_address' => 'F地区',
                'representative_name' => 'F太郎',
            ],
            [
                'company_name' => 'G社',
                'street_address' => 'G地区',
                'representative_name' => 'G太郎',
            ],
            [
                'company_name' => 'H社',
                'street_address' => 'H地区',
                'representative_name' => 'H太郎',
            ],
            [
                'company_name' => 'I社',
                'street_address' => 'I地区',
                'representative_name' => 'I太郎',
            ],
            [
                'company_name' => 'J社',
                'street_address' => 'J地区',
                'representative_name' => 'J太郎',
            ]
  ]);
    }
}
