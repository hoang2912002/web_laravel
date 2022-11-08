<?php

namespace Database\Factories;

use App\Enums\StudentStatusEnum;
use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' =>$this->faker-> name(),
            'gender' =>$this->faker->boolean(),
            'course_id' =>Course::inRandomOrder()->value('id'),
            'status' =>$this->faker->randomElement(StudentStatusEnum::asArray()),
            'birthdate' =>$this->faker->dateTimeBetween('-30 years','-18 years'),
            //Ở đây tức là mình sẽ khai báo là lấy dữ liệu ảo từ thằng faker và sau đó random ra từng column cho nó
        ];
    }
}
