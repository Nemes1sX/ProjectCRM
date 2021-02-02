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
         [
             'name' => 'Petro Pienas',
            'industry' => 'Farming',
             'size' => '50-100',
             'ceoname' => 'Katinas Petras'
         ],
            [
                'name' => 'Juodas miskas',
                'industry' => 'Electronics',
                'size' => '50-100',
                'ceoname' => 'Senelis'
            ],
            [
                'name' => 'Sviestas sviestuotas',
                'industry' => 'Farming',
                'size' => '50-100',
                'ceoname' => 'Hello World'
            ],
            [
                'name' => '	Katuotas Batinas',
                'industry' => 'Farming',
                'size' => '50-100',
                'ceoname' => 'Petras Petrauskas'
            ],
            [
                'name' => 'Raspsodatas',
                'industry' => 'Food',
                'size' => '10-50',
                'ceoname' => 'Mindauginins BMW'
            ],
        ];
        foreach($companies as $company){
            \App\Company::create($company);
        }
    }
}
