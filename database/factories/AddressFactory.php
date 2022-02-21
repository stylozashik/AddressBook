<?php

namespace Database\Factories;

use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

class AddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Address::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'number'    => $this->faker->number,
            'street'    => $this->faker->streetName,
            'city'      => $this->faker->city,
            'state'     => $this->faker->state,
            'zip'       => $this->faker->postcode,
            'type'      => 'home',
            'contact_id'=> factory(App\Models\Contact::class),
        ];
    }
}
