<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Company::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'email' => $this->faker->safeEmail,
            'activity' => random_int(0,1) == 0 ? null : $this->faker->sentence(random_int(2 , 7)),
            'website' => random_int(0,1) == 0 ? null : $this->faker->url,
            'logo' => $this->faker->imageUrl(150 , 150) //Image can be both URL or Path and we simply do a check with code on getImageSourceAttribute accessor on Company Model
        ];
    }
}
