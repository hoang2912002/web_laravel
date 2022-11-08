<?php

namespace App\Models;

use Attribute;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Student extends Model
{
    use HasFactory;
    protected $fillable= [
        'name',
        'gender',
        'course_id',
        'status',
        'avatar',
        'birthdate',
    ];
    public function getAgeAttribute()
    {
        return $age = date_diff(date_create($this->birthdate), date_create())->y;   
    }

    public function getGendernameAttribute()
    {
        return ($this->attributes['gender'] === 0) ? 'Male' : 'Female';
    }

    public function comments(){
        return $this->hasOne(Course::class, 'id', 'course_id');

        //beLongTo nghĩa là 1 thằng Course sẽ thuộc về nhiều lớp
    }




    
    // public function getCourseNameAttribute()
    // {
        
    //     return Course::get()->first()->name;
    // }
    //Câu hỏi buổi 14
    //Những cách lưu và hiển thị giá trị trong DB
   
}
