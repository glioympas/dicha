<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Database\Seeder;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$digitalChallenge = Company::where('name' , 'digital challenge_')->first();

        $sampleEmployees = [
        	[
	    		'name' => 'George Lioympas',
	        	'email' => 'g.lioympas@gmail.com',
	        	'company_id' => $digitalChallenge ? $digitalChallenge->id : Company::inRandomOrder()->first()->id,
	        	'phone' => '+306980121725'
        	],

        	[
	    		'name' => 'Mixalis Papadopoulos',
	        	'email' => 'mixalispap@gmail.com',
	        	'company_id' => Company::inRandomOrder()->first()->id,
	        	'phone' => '+306980128811'
        	]
        ];


        foreach($sampleEmployees as $employee) {
        	Employee::create($employee);
        }

    }
}
