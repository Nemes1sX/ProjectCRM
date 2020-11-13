<?php

use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $companies = [
        [  'name' => 'Sveikas',
            'ceoname' => 'Petras',
            'industry' => 'drinks',
            'size' => '50-100'
            ],
        ];
        foreach($companies as $company){
            \App\Company::create($company);
        }
    }
}
