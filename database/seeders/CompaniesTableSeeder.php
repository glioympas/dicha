<?php

namespace Database\Seeders;

use App\Models\Company;
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
        $sampleCompanies = [
        	[
        		'name' => 'digital challenge_',
        		'email' => 'info@dicha.gr',
        		'activity' => 'Web Agency',
        		'website' => 'https://dicha.gr',
        		'logo' => 'https://www.dicha.gr/uploads/images/dicha-logo-green.png' //Note: Logo can have URL OR Path , we seperate them with code
        	],

        	[
        		'name' => 'nondigital challenge',
        		'email' => 'info@nondicha.gr',
        		'activity' => 'Not Web Agency',
        		'website' => 'https://nondicha.gr',
        	]
        ];

        foreach($sampleCompanies as $company) {
        	Company::create($company);
        }
    }
}
