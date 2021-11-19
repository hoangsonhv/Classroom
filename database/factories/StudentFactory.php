<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Student::class;

    public function definition()
    {
        return [
            "name"=>$this->faker->name(),
            "phone"=>$this->faker->numberBetween(1111111111,999999999),
            "address"=>$this->faker->address(),
            "link"=>$this->faker->url(),
            "phone_parent"=>$this->faker->numberBetween(1111111111,999999999),
            "note"=>$this->faker->paragraph(),
            "id_subject"=>[mt_rand(1,20),mt_rand(1,20)],
        ];
    }
}
