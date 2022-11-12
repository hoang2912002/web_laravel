<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;
use App\Http\Middleware\CheckLoginMiddleware;
use App\Http\Middleware\CheckSuperAdminMiddleware;
use Illuminate\Support\Facades\Route;



// Route::get('courses',[CourseController::class,'index']);
// Route::get('courses/create',[CourseController::class,'create'])->name('course.create');
// Route::get('courses/create',[CourseController::class,'store'])->name('course.store');

//Thay vì để nó lập đi lập lại đoạn 'courses' và 'course.' thì thường ngta sẽ nhóm nó vào 1 nhóm cho nhìn dễ
//và pro hơn
//Route::group(['prefix']) 
//'prefix' tức là tiền tố đằng trước và mình sẽ truyền vào là courses
//'as'  là tiền tố đằng sau
// Route::group(['prefix'=>'courses','as'=>'course.'],function(){
//     Route::get('/',[CourseController::class,'index'])->name('index');
//     Route::get('/create',[CourseController::class,'create'])->name('create');
//     Route::post('/create',[CourseController::class,'store'])->name('store');
//     Route::delete('/destroy/{course}',[CourseController::class,'destroy'])->name('destroy');
//     // khi mà method route là delete thì url của nó sẽ cần chèn theo 1 cái mã và mình tự đặt tên cho nó vd: course
//     Route::get('/edit/{course}',[CourseController::class,'edit'])->name('edit');
//     Route::put('/update/{course}',[CourseController::class,'update'])->name('update');
// });
//Thay vì mình nhóm nó vào như trên thì mình chỉ cần ghi resource
Route::get('login', [AuthController::class,'login'])->name('login');
Route::post('login',[AuthController::class, 'processLogin'])->name('process_login');
Route::group([
    'middleware' =>  CheckLoginMiddleware::class,    
],function(){
    Route::get('logout', [AuthController::class,'logout'])->name('logout');
    Route::resource('courses', CourseController::class)->except([
        'show',
        'destroy'
        
    ]);
    Route::get('courses/api',[CourseController::class,'api'])->name('courses.api');
    Route::get('courses/api/name',[CourseController::class,'apiName'])->name('courses.api.name');
    // Route::get('test',function(){
    //     return view('layout.master');
    // });

    Route::resource('students', StudentController::class)->except([
        'show',
        'destroy'
    ]);
    Route::get('students/api',[StudentController::class,'api'])->name('students.api');
    Route::get('students/api/name',[CourseController::class,'apiName'])->name('students.api.name');
    Route::group([
        'middleware' =>  CheckSuperAdminMiddleware::class,    
    ],function(){
        Route::delete('courses/{course}',[CourseController::class,'destroy'])->name('courses.destroy');
        Route::delete('students/{student}',[StudentController::class,'destroy'])->name('students.destroy');

    });
});
