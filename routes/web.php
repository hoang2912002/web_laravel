<?php

use App\Http\Controllers\CourseController;
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
Route::resource('courses', CourseController::class)->except(['show']);
Route::get('courses/api',[CourseController::class,'api'])->name('courses.api');
Route::get('courses/api/name',[CourseController::class,'apiName'])->name('courses.api.name');
Route::get('test',function(){
    return view('layout.master');
});
  