<?php

namespace App\Http\Controllers;

use App\Enums\StudentStatusEnum;
use App\Http\Requests\StoreStudentRequest as RequestsStoreStudentRequest;
use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Course;
use Directory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;

class StudentController extends Controller
{
    private Model $model;
    public function __construct()
    {
        ($this->model = new Student())->query(); 
        $routeName = Route::currentRouteName();
        $arr = explode('.' , $routeName);
        $arr = array_map('ucfirst', $arr);
        $title = implode('-',$arr);
        
        $arrstudentStatus = StudentStatusEnum::getArrayValue();
        View::share('title', $title);
        View::share('arrstudentStatus', $arrstudentStatus);
        
    }
    public function index()
    { 
        return view('student.index');
    }
    public function api(Request $request)
    {   
        
        //Có thể chơi cách này để lấy course_name
        // $query = $this->model->select('students.*')->addSelect('courses.name as course_name')
        // ->join('courses', 'courses.id' , 'students.course_id');
        $query = $this->model->with('comments');
        
        return DataTables::of($this->model::query())
           ->addColumn('course_name', function ($object) {
               return $object->comments->name;
            })
            ->addColumn('age', function ($object) {
                return $object->age;
            })
            ->addColumn('gendername', function ($object) {
                return $object->gendername;
            })
            ->editColumn('status', function ($object) {
                //return StudentStatusEnum::fromValue($object->status);
                //Lúc đầu giá trị của nó chỉ là 1, 2 , 3;
                //Dùng method fromValue để trả về chính giá trị chứ k trả về key 
                return StudentStatusEnum::getKeyByValue($object->status);
            })
            ->addColumn('edit',function($object){
                    return route('students.edit',$object);
            })
            ->addColumn('destroy',function($object){
                return route('students.destroy',$object);
            })
            ->filterColumn('course_name', function($query, $keyword) {
                
                if($keyword !== 'null'){
                    $query->whereHas('comments', function ($q) use($keyword){
                    return $q->where('id', $keyword);
                });
                }
                
                //whereHas này là gọi relationship 
            })
            ->filterColumn('status', function($query, $keyword) {
                if($keyword !== '0' ){
                    $query->where('status' , $keyword) ;
                }
            })
            ->rawColumns(['course_name','gendername'])
            
            ->make(true);
            
            
        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $course=  Course::get();
        // $student = $this->model::get('gender')->last();
        // dd($student);
        
        return view('student.create',[
            'course' => $course,
            
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStudentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudentRequest $request)
    {
        $path = Storage::disk('public')->putFile('avatars', $request->file('avatar'));
        $arr = $request->validated();
        $arr['avatar'] = $path;
        $object = new $this->model;
        $object->create($arr);
        // $object->save();
        return redirect()->route('students.index')->with('success', 'Đã thêm thành công');
        #with() là để in ra 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        $course = Course::get();
        return view('student.edit',[
            'student' => $student,
            'course' => $course,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStudentRequest  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }
}
