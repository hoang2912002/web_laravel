<?php

namespace App\Http\Controllers;

use App\Http\Requests\Course\DestroyRequest;
use App\Http\Requests\Course\StoreRequest;
use App\Http\Requests\Course\UpdateRequest;
use App\Models\Course;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('q');
        $data = Course::where('name','LIKE','%' . $search . '%')->paginate(3);
        $data->appends(['q' => $search]);
        //appends tức là khi mình search 1 từ nào đó thì $request nó sẽ truyền q lấy giá trị đó ra 
        //nhưng mà vấn đề là khi mình giả sử mik tìm kiếm 'Bút' nó hiện ra 3 pages tất cả 
        // nhưng mà khi mik nhấn next thì page sẽ nhảy sang trang tiếp theo nma nó mất đi q ở trên thanh địa chỉ nên
        // $request mặc định lấy gtri của q là null 
        // vì v dùng appends để nó thêm giá trị của q vào attribute $search
        return view('course.index',[
            'data' =>$data,
            'search' => $search,
            
        ]);
        
    } 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('course.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCourseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        
        $object = new Course();
        $object->fill($request->validated());
        //validated tức là là sẽ lấy những thằng đã đc khai báo ở trong Request

        // $object->name = $request->get('name');
        // $object->fill($request->except('_token'));
        //fill tức là nó sẽ lấp đầy theo đúng tất cả những thứ mình truyền vào 
        //Có 1 lưu ý là tên của fill mình truyền vào phải đúng với cái cột trên database tức là input(name ="name") === cột name trong db
        // vì trong form luôn luôn có 1 token tồn tại nên mình cần phải except nó đi vì trong db mình k có cột như thế
        // Sau đó run nó sẽ in ra lỗi 
        //Add [name] to fillable property to allow mass assignment on [App\Models\Course].
        // Bởi vì laravel nó sẽ tự động kiểm tra cho mik nó sẽ hỏi là cái cột đó k nằm trong phần có thể điền được
        // của model nghĩa là mình cần phải khai báo những cái có thể điền được cho chính thằng Model ở Models.Course thì nó mới cho phép 
        //mình làm như này 
        $object->save();
        
        // //Cách 2
        // Course::create($request->except('_token'));
        //điều hướng quay về
        return redirect()->route('courses.index');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        return view('course.edit',['course'=>$course]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCourseRequest  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Course $course)
    {
        //Cách 1 k biến thằng $course thành đối tương(Query builder)
        // Course::query()->where('id',$course->id)->update(
        //     $request->except(
        //         '_token',
        //         '_method',
        //     ));
        $course->update(
            $request->except(
                '_token',
                '_method',
            ));
            return redirect()->route('courses.index');

        //Viết theo kiểu OOP Elequen
        //
        // $course->find($request->except('_token'));
        // $course->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(DestroyRequest $request, Course $course)
    {
        //Cách 1 Course $course ở đây tức là laravel đã ép kiểu cho mình thành 1 đối tượng 
        //cách này sẽ tiện hơn vì laravel sẽ valid cho mình là thằng này có exist hay k r nó sẽ báo lối lại
        $course->delete();
        //Cách 2:
        // Course::destroy($course->id);
        //or Course::where('id',$course->id)->delete();
        //Đây là cách viết Query builder tứ là nó sẽ tự sinh ra câu SQL theo kiểu gọi đến hàm 
        return redirect()->route('courses.index');


    }
}

//Homework buổi 9 là method create và update có khởi tạo đối tượng Course ko
//create có khởi tạo đối tương
//khởi tạo đối tượng tức là nó insert r  còn select lại về cho mình cái mà mình insert 
//update k khởi tạo đối tượng vì update nó thường là xử lý những thằng where 
// where thường là hợp cho câu SQL là mass update là xử lý nhiều thằng cùng 1 lúc
