<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'company_id' => Company::inRandomOrder()->first()->id,
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'phone' => random_int(0,1) == 0 ? null :  $this->faker->phoneNumber
        ];
    }
}
