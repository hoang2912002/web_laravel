<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Course::factory(10)->create();
        //sẽ tạo 10 khóa học
        Student::factory(500)->create();
        //sau đó chạy command line php artisan migrate --seed 
        //để vừa chạy DB vừa chạy seed
    }
}
